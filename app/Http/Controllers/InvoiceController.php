<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class InvoiceController extends Controller
{
    /**
     * Generate and stream the invoice PDF for a given order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function generate(Order $order)
    {
        // Chokkas karo ke user potano j order access kari rahyo chhe
        if (auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', compact('order'));

        return $pdf->stream('invoice-BLINGIT-'.$order->id.'.pdf');
    }
}

