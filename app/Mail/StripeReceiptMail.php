<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StripeReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiptUrl;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $receiptUrl)
    {
        $this->user = $user;
        $this->receiptUrl = $receiptUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Stripe Receipt Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pdf_template.pdf_receipt',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Your Stripe Receipt')
                    ->view('pdf_template.pdf_receipt')
                    ->with([
                        'name' => $this->user->name,
                        'receiptUrl' => $this->receiptUrl,
                    ]);
    }

}
