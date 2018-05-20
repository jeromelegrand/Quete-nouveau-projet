<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 15/05/18
 * Time: 11:39
 */

namespace AppBundle\Service;


class Mailer
{
    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendEmail(bool $pilot, string $receiver)
    {
        $body = $this->templating->render('emails/regisration.html.twig', [
           'receiver' => $receiver,
            'pilot' => $pilot
        ]);
        $message = (new \Swift_Message('Reservation Flyaround'))
            ->setFrom('reservation@flyaround.com')
            ->setTo($receiver)
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }
}