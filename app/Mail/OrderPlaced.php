<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Mail\Mailables\Attachment;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Blingit Grocery Order Confirmation #' . $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.placed',
            with: [
                'orderUrl' => route('orders'), // Assuming you have an orders history page
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // PDF generate kari ne tene email sathe attach karo
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', ['order' => $this->order]);
        
        return [
            Attachment::fromData(fn () => $pdf->output(), 'invoice-BLINGIT-'.$this->order->id.'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
