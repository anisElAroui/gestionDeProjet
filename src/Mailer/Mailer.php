<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 16/05/18
 * Time: 12:22
 */

namespace App\Mailer;

class Mailer
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer,$templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendEmail($subject,$fromEmail,$toEmail,$charter)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody(
                $this->templating->render(
                    'Emails/createCharter.html.twig', array('charter'=>$charter)
                ),'text/html'
            )
        ;
        $this->mailer->send($message);
    }

    public function sendComplete($subject,$fromEmail,$toEmail,$charter)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody(
                $this->templating->render(
                    'Emails/completeCharter.html.twig', array('charter'=>$charter)
                ),'text/html'
            )
        ;
        $this->mailer->send($message);
    }

    public function sendNegotiation($subject,$fromEmail,$toEmail,$charter)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody(
                $this->templating->render(
                    'Emails/negotiation.html.twig', array('charter'=>$charter)
                ),'text/html'
            )
        ;
        $this->mailer->send($message);
    }

    public function sendDecision($subject,$fromEmail,$toEmail,$charter)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody(
                $this->templating->render(
                    'Emails/decision.html.twig', array('charter'=>$charter)
                ),'text/html'
            )
        ;
        $this->mailer->send($message);
    }

    public function sendValidation($subject,$fromEmail,$toEmail,$charter)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody(
                $this->templating->render(
                    'Emails/validateProject.html.twig', array('charter'=>$charter)
                ),'text/html'
            )
        ;
        $this->mailer->send($message);
    }
}