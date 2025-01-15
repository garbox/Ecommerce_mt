<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data){
        $this->data = $data;
    }

    public function envelope(): Envelope{
        return new Envelope(
            subject: 'This is test email from Modern Tables',
        );
    }

    public function content(): Content{
        return new Content(
            view: 'email.invoice',
        );
    }

    public function build()
    {
        return $this->view('email.invoice')
                    ->with('data', $this->data);
    }
}
