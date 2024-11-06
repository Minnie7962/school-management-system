<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $student;
    /**
     * Create a new message instance.
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our School',
            from: new \Illuminate\Mail\Mailables\Address('your-email@example.com', 'School Name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function build(): Content
    {
        return new Content(
            view: 'emails.student.welcome',
            with: [
                'student' => $this->student,
            ],
        );
    }
    
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
