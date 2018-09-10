<?php

namespace Fx\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function sendMailAction(Request $request, \Swift_Mailer $mailer)
    {
        // On récupère les différents élements du message.
        $mailSenderName = $request->get('mailSenderName');
        $mailSenderAddress = $request->get('mailSenderAddress');
        $mailBody = "";

        // Validation
        $errors = $this->validateMail($mailSenderName, $mailSenderAddress, $mailBody);

        if (empty($errors)) {
            $message = (new \Swift_Message('Ffouillet.fr - Nouveau contact'))
                ->setFrom('send@example.com')
                ->setTo($this->getParameter('mail_to'))
                ->setBody(
                    $this->renderView(
                        'email/index.html.twig',
                        array('mailSenderName' => $mailSenderName,
                            'mailSenderEmailAddress' => mailSenderEmailAddress,
                            'mailBody' => $mailBody)
                    ),
                    'text/html'
                )
            ;
        }

        $mailer->send($message);


    }

    public function validateMail($mailSenderName, $mailSenderEmailAddress, $mailBody) {

        $errors = [];

        if ($mailSenderName == "" || strlen($mailSenderName) < 2) {
            $errors[] = "Merci de renseigner votre nom (2 caractères minimum)";
        }

        if (mailSenderEmailAddress == "" || strlen(mailSenderEmailAddress) < 3) {
            $errors[] = "Merci de saisir votre adresse email dans le format suivant : nom@monemail.com";
        }

        if ($mailBody == "" || strlen($mailBody) < 3) {
            $errors[] = "Le contenu de votre message ne peut pas être vide.";
        }

        if ($mailBody > 2000) {
            $errors[] = "Le contenu de votre message ne peut pas excéder 2000 caractères.";
        }

        return $errors;
    }
}
