<?php

namespace Fd\EdificioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EdificioBundle\Entity\Edificio;

class Edificios extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Edificio();
        $entity->setComuna($manager->merge($this->getReference('comuna14')));
        $entity->setCgp($manager->merge($this->getReference('cgp2')));
        $entity->setBarrio($manager->merge($this->getReference('PAL')));
        $entity->setDistritoEscolar($manager->merge($this->getReference('distrito14')));
        $entity->setCui(123456789);
        $entity->setSuperficie(1000);
//        $entity->setEstablecimiento();
        $this->addReference(''.$entity->getCui(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        
        $entity = new Edificio();
        $entity->setComuna($manager->merge($this->getReference('comuna12')));
        $entity->setCgp($manager->merge($this->getReference('cgp4')));
        $entity->setBarrio($manager->merge($this->getReference('ALM')));
        $entity->setDistritoEscolar($manager->merge($this->getReference('distrito7')));
        $entity->setCui(123456790);
//        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 8')));
        $entity->setSuperficie(1500);
        $this->addReference(''.$entity->getCui(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new Edificio();
        $entity->setComuna($manager->merge($this->getReference('comuna12')));
        $entity->setCgp($manager->merge($this->getReference('cgp4')));
        $entity->setBarrio($manager->merge($this->getReference('ALM')));
        $entity->setDistritoEscolar($manager->merge($this->getReference('distrito7')));
        $entity->setCui(123456791);
        $entity->setSuperficie(500);
        $this->addReference(''.$entity->getCui(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
    }

    public function getOrder() {
        return 300;
    }
}
?>
