<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class ApiContactController extends AbstractController
{
    #[Route('/api/contact', name: 'api_contact', methods: ['POST'])]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $lastname = $request->request->get('lastname');
        $firstname = $request->request->get('firstname');
        $userEmail = $request->request->get('email');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        // Vérifier si l'adresse e-mail est définie
        if ($userEmail) {
            // Build email content
            $emailSubject = 'Contact request from ' . $userEmail;
            $emailContent = $lastname . ' ' . $firstname . ' has sent you the following message: ' . $message;

            // Create the email
            $email = (new Email())
                ->from(new Address($userEmail))
                ->to('tadjerliticia@gmail.com')
                ->subject($emailSubject)
                ->text($emailContent)
                ->html('<p>' . nl2br($emailContent) . '</p>');

            // Send the email
            $mailer->send($email);

            // Redirect with a success flash message
            $this->addFlash('success', 'Your message has been sent.');
              // Return a success response
            return new JsonResponse(['message' => 'Your message has been sent.'], Response::HTTP_OK);
        } else {
            // L'adresse e-mail n'est pas définie, gérer l'erreur
            return new Response('Email address is missing.', Response::HTTP_BAD_REQUEST);
        }
    }
}


