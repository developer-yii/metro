<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Offer;

class OfferPriceChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $offerName;
    public $oldPrice;
    public $newPrice;

    /**
     * Create a new message instance.
     */
    public function __construct(Offer $offer, $oldPrice, $newPrice)
    {
        $this->offerName = $offer->productName;
        $this->oldPrice = $oldPrice;
        $this->newPrice = $newPrice;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Offer Price Changed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        \Log::info($this->offerName);
        return new Content(
            markdown: 'admin.mails.priceChanged',
            with: [
                'offerName' => $this->offerName,
                'oldPrice' => $this->oldPrice,
                'newPrice' => $this->newPrice
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
        return [];
    }
}
