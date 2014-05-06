<?php

namespace Fd\EdificioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;

class DomicilioLocalizaciones extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('Córdoba 1950')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 1 Ini 00')));
        $entity->setPrincipal(false);
        
        $manager->persist($entity);
        $manager->flush();

        $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('Córdoba 1950')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 1 Med 00')));
        $entity->setPrincipal(false);
        
        $manager->persist($entity);
        $manager->flush();

                $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('Córdoba 1950')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 1 Pri 00')));
        $entity->setPrincipal(false);
        
        $manager->persist($entity);
        $manager->flush();

                $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('Córdoba 1950')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 1 Ter 00')));
        $entity->setPrincipal(true);
        
        $manager->persist($entity);
        $manager->flush();

                $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('La Rioja 1042')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 8 Med 00')));
        $entity->setPrincipal(false);
        
        $manager->persist($entity);
        $manager->flush();

                $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('La Rioja 1042')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 8 Ter 00')));
        $entity->setPrincipal(false);
        
        $manager->persist($entity);
        $manager->flush();

                $entity = new DomicilioLocalizacion();
        $entity->setDomicilio($manager->merge($this->getReference('Carlos Calvo 3150')));
        $entity->setLocalizacion($manager->merge($this->getReference('ENS 8 Pri 01')));
        $entity->setPrincipal(false);
        
        $manager->persist($entity);
        $manager->flush();

    }

    public function getOrder() {
        return 450;
    }
}
?>
