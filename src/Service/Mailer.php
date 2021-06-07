<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class Mailer{

    

    public function __construct(private Environment $twig,private \Swift_Mailer $mailer,private ParameterBagInterface $params)
    {
    }

    public function sendMail($user,$subject,$templete)
    {
        $from=$this->params->get("mailer_from");
        $fromName=$this->params->get("mailer_from_name");

        $email=(new \Swift_Message($subject))
                ->setFrom($from)
                ->setTo($user->getUsername())
                ->setBody(
                    $this->twig->render($templete),
                    contentType: "text/html"
                );
            $this->mailer->send($email);
    }
}