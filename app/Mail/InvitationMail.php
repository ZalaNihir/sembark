<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $acceptUrl,
        public string $companyName,
        public bool $isAdmin,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->isAdmin
                ? "You are invited to manage {$this->companyName} on Sembark"
                : "You are invited to join {$this->companyName} on Sembark",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invitation',
            with: [
                'companyName' => $this->companyName,
                'isAdmin' => $this->isAdmin,
            ],
        );
    }
}
