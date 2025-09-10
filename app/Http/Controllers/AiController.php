<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function suggest(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'Please enter a query.'], 400);
        }

        // 1. API Key ne sachi rite config mathi lavo
        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            return response()->json(['error' => 'Gemini API key is not configured.'], 500);
        }

        // 2. Sacha ane latest model no upyog karo
        $model = 'gemini-1.5-flash-latest'; 
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        $payload = [
            'contents' => [['parts' => [['text' => $query]]]]
        ];

        try {
            $response = Http::timeout(30)->post($url, $payload);

            if ($response->failed()) {
                return response()->json([
                    'error'   => 'Gemini API error',
                    'details' => $response->json() ?? $response->body(),
                ], $response->status());
            }

            $data = $response->json();
            $answer = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I could not find an answer.';

            return response()->json(['answer' => $answer]);

        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Server error during API call.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
