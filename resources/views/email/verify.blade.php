@extends('layout')

@section('title', 'Verify Your Email Address')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-gray-200 p-8 text-center">
        
        <div class="mb-6">
            <div class="bg-green-100 p-4 rounded-full mb-5 ring-4 ring-green-50 w-24 h-24 mx-auto flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900">Verify Your Email Address</h1>
            <p class="text-gray-600 mt-2">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
            </p>
        </div>

        @if (session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg text-left" role="alert">
                <p class="font-bold">A fresh verification link has been sent to your email address.</p>
            </div>
        @endif

        <div class="mt-6 flex items-center justify-center gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
