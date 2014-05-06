<?php

namespace Fd\UsuarioBundle\Listener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class LoginListener {
    
    private $securityContext;
    private $em;
    
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine) {
        $this->securityContext = $securityContext;
        $this->em = $doctrine->getEntityManager();
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            
            $usuario = $event->getAuthenticationToken()->getUser();
            
            $usuario->setConexionAnterior($usuario->getConexionActual());

            $usuario->setConexionActual(new \DateTime());
            
            $this->em->persist($usuario);
            $this->em->flush($usuario);
        }
        
    }
}
