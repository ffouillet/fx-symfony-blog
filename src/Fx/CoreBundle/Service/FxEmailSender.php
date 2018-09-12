<?php

namespace Fx\CoreBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class FxEmailSender {

    private $mailer;
    private $mail_to;
    private $twig; // Utilisé pour rendre la vue du mail à envoyer

    public function __construct(\Swift_Mailer $mailer, $mail_to, \Twig\Environment $twig)
    {
        $this->mailer = $mailer;
        $this->mail_to = $mail_to;
        $this->twig = $twig;
    }

    public function sendMail(Request $request)
    {
        // On récupère les différents élements du message.
        $mailSenderName = $request->get('mailSenderName');
        $mailSenderEmailAddress = $request->get('mailSenderEmailAddress');
        $mailBody = $request->get('mailBody');

        // Validation
        $errors = $this->validateMail($mailSenderName, $mailSenderEmailAddress, $mailBody);

        if (empty($errors)) {
            $message = (new \Swift_Message('Ffouillet.fr - Nouveau message'))
                ->setFrom($mailSenderEmailAddress)
                ->setTo($this->mail_to)
                ->setBody(
                    $this->twig->render(
                        'fx/email/index.html.twig',
                        array('mailSenderName' => $mailSenderName,
                            'mailSenderEmailAddress' => $mailSenderEmailAddress,
                            'mailBody' => $mailBody)
                    )
                )
                ->setContentType('text/html')
            ;
        } else {
            return $errors;
        }

        $this->mailer->send($message);

    }

    public function validateMail($mailSenderName, $mailSenderEmailAddress, $mailBody) {

        $errors = [];

        if ($mailSenderName == "" || strlen($mailSenderName) < 2) {
            $errors[] = "Merci de renseigner votre nom (2 caractères minimum)";
        }

        if ($mailSenderEmailAddress == ""
            || strlen($mailSenderEmailAddress) < 3
            || !filter_var($mailSenderEmailAddress, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Merci de saisir votre adresse email dans le format suivant : nom@monemail.com";
        }

        if ($mailBody == "") {
            $errors[] = "Le contenu de votre message ne peut pas être vide ou.";
        }

        if (strlen($mailBody) < 3) {
            $errors[] = "Le contenu de votre message ne peut pas être inférieur à 3 caractères.";
        }

        if ($mailBody > 2000) {
            $errors[] = "Le contenu de votre message ne peut pas excéder 2000 caractères.";
        }

        return $errors;
    }
}