<?php

namespace App\Controller\EventListener;

// src/App/EventListener/JWTCreatedListener.php

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;


class JWTCreatedListener
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        $data = $event->getData();
        $user = $event->getUser();

        $data['id'] = $user->getId();
        $data['username'] = $user->getUsername();
        $data['email'] = $user->getMail();

        $event->setData($data);
    }
}
