<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Report Mail'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.mailcontent',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
