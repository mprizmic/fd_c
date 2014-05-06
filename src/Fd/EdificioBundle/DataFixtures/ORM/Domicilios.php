<?php

namespace Fd\EdificioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EdificioBundle\Entity\Domicilio;

class Domicilios extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Domicilio();
        $entity->setCalle('Córdoba');
        $entity->setAltura(1950);
        $entity->setPrincipal(TRUE);
        $entity->setEdificio($manager->merge($this->getReference('123456789')));
        
        $this->addReference($entity->getCalle().' '.$entity->getAltura(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Domicilio();
        $entity->setCalle('La Rioja');
        $entity->setAltura(1042);
        $entity->setPrincipal(TRUE);
        $entity->setEdificio($manager->merge($this->getReference('123456790')));
        
        $this->addReference($entity->getCalle().' '.$entity->getAltura(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Domicilio();
        $entity->setCalle('Carlos Calvo');
        $entity->setAltura(3150);
        $entity->setPrincipal(TRUE);
        $entity->setEdificio($manager->merge($this->getReference('123456791')));
        
        $this->addReference($entity->getCalle().' '.$entity->getAltura(), $entity);
        $manager->persist($entity);
        $manager->flush();
    }

    public function getOrder() {
        return 310;
    }
}
?>
