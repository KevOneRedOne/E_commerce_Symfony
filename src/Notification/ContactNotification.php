<?php

namespace App\Notification;

use App\Entity\User;
use Twig\Environment;
use App\Entity\Contact;

class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environmen t
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        // hors d'un controller, on ne peut faire d'injections de dépendances seulement dans un constructeur
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message("Nouveau message de contact"))   // objet du mail
                ->setFrom($contact->getEmail()) // expéditeur
                ->setTo('ecommerce@contact.com') // destinataire
                ->setReplyTo($contact->getEmail())  // adresse de réponse
                ->setBody($this->renderer->render('emails/contact.html.twig', [
                    'contact' => $contact
                ]), 'text/html');   // il faut préciser que le corps du mail est un fichier html pour interpréter les balises
        $this->mailer->send($message);
    }

    public function registerEmail(User $user)
    {
        $message = (new \Swift_Message("Vous êtes inscrit sur le site"))   // objet du mail
        ->setFrom('ecommerce@contact.com') // expéditeur
            ->setTo( $user->getEmail()) // destinataire
            ->setReplyTo('ecommerce@contact.com')  // adresse de réponse
            ->setBody($this->renderer->render('emails/register.html.twig', [
                'user' => $user
            ]), 'text/html');   // il faut préciser que le corps du mail est un fichier html pour interpréter les balises
        $this->mailer->send($message);
    }
}