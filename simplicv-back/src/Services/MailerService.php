<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendEmail(string $from, string $subject, string $content): void
    {
        $email = (new Email())
            ->from($from)
            ->to('tadjerliticia@gmail.com') // Remplacez par votre adresse e-mail de destinataire
            ->subject($subject)
            ->text($content)
            ->html('<p>' . nl2br($content) . '</p>');

        $this->mailer->send($email);
    }
}
