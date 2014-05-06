<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\CargoAutoridad;

class CargoAutoridades extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new CargoAutoridad();
        $entity->setAbreviatura('DirP');
        $entity->setNombre('Director/a de primaria');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
              
        $entity = new CargoAutoridad();
        $entity->setAbreviatura('ViceP');
        $entity->setNombre('Vicedirector/a de primaria');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new CargoAutoridad();
        $entity->setAbreviatura('Reg');
        $entity->setNombre('Regente');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new CargoAutoridad();
        $entity->setAbreviatura('Vicedir.');
        $entity->setNombre('Vicediretor/A');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new CargoAutoridad();
        $entity->setAbreviatura('Rec');
        $entity->setNombre('Rector/a');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new CargoAutoridad();
        $entity->setAbreviatura('Vicerec');
        $entity->setNombre('Vicerrector/a');
        $this->addReference($entity->getAbreviatura(), $entity);
        $manager->persist($entity);
        $manager->flush();
    }

    public function getOrder() {
        return 175;
    }
}
?>
