<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOffers extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Offers',
            from:'Offers@ecocarthub.com',
            cc:'abdullah@ecocarthub.com',
            bcc:'abdullah111@ecocarthub'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.offers',

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath(public_path('assets/admin/dist/img/avatar.png')),
            Attachment::fromStorage('category/image/afgHBK7K8qJ86Al1fO1QLEgL4nRGVc4Ih1EiORm0.jpg')
                ->as('image.jpeg')
                ->withMime('image/jpeg'),

        ];
    }
}
