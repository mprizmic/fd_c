<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Barrio;

class Barrios extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Barrio();
        $entity->setAbreviatura('PAL');
        $entity->setNombre('Palermo');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Barrio();
        $entity->setAbreviatura('ALM');
        $entity->setNombre('Almagro');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Barrio();
        $entity->setAbreviatura('FLO');
        $entity->setNombre('Flores');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new Barrio();
        $entity->setAbreviatura('URQ');
        $entity->setNombre('Villa Urquiza');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
    }

    public function getOrder() {
        return 170;
    }
}
?>
