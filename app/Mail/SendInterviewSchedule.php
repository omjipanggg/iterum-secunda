<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInterviewSchedule extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name') . '—Sesi Wawancara',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.send-interview-schedule',
            with: [
                'data' => $this->data,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
