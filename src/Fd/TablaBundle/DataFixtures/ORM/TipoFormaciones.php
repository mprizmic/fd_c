<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\TipoFormacion;

class TipoFormaciones extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new TipoFormacion();
        $entity->setCodigo('FD');
        $entity->setDescripcion('Formación Docente');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new TipoFormacion();
        $entity->setCodigo('FT');
        $entity->setDescripcion('Formación Técnica');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    }

    public function getOrder() {
        return 205;
    }
}

