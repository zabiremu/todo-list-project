<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Todo;

class TodoReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Todo $todo, public string $csvPath) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: ' . $this->todo->title . ' is Due Soon',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.todo_reminder',
            with: [
                'todo' => $this->todo,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->csvPath)
                ->as('posts_data.csv')
                ->withMime('text/csv'),
        ];
    }
}
