<?php


namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function onResponse(ResponseEvent $responseEvent)
    {
        //passer à true met le site en maintenance
        $maintenance = false;

        if($maintenance) {
            $content = $this->twig->render('maintenance/maintenance.html.twig');

            $response = new Response($content);

            return $responseEvent->setResponse($response);
        }
        return $responseEvent->getResponse()->getContent();
    }
    public static function getSubscribedEvents()
    {
        return [
          KernelEvents::RESPONSE => 'onResponse'
        ];
    }
}