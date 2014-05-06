<?php

namespace Fd\UsuarioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Fd\UsuarioBundle\Entity\Usuario;

class Usuarios extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface {
   
    private $container;
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    public function load(ObjectManager $manager) {
              
        $entity = new Usuario();
        $entity->setApellido('Perez');
        $entity->setNombre('Juan');
        $entity->setEmail('jp@jp.com.ar');
        $entity->setSalt(md5(time()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($entity);
        $entity->setPassword($encoder->encodePassword('123', $entity->getSalt()));
        $entity->setRol($manager->merge($this->getReference('ROLE_USUARIO')));        
        
        $this->addReference($entity->getApellido().$entity->getNombre(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new Usuario();
        $entity->setApellido('Prizmic');
        $entity->setNombre('Marcelo');
        $entity->setEmail('mp@mp.com.ar');
        $entity->setSalt(md5(time()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($entity);
        $entity->setPassword($encoder->encodePassword('123', $entity->getSalt()));
        $entity->setRol($manager->merge($this->getReference('ROLE_ADMIN')));        
        
        $this->addReference($entity->getApellido().$entity->getNombre(), $entity);
        $manager->persist($entity);
        $manager->flush();

    }

    public function getOrder() {
        return 550;
    }
}
?>
