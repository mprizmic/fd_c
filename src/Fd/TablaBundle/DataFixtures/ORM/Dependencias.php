<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Dependencia;

class Dependencias extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $entity = new Dependencia();
        $entity->setCodigo('RCT');
        $entity->setNombre('Rectoría');
        $entity->setOrden(1);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    
        $entity = new Dependencia();
        $entity->setCodigo('SCT');
        $entity->setNombre('Secretaría');
        $entity->setOrden(2);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    
        $entity = new Dependencia();
        $entity->setCodigo('NI');
        $entity->setNombre('Nivel Inicial');
        $entity->setOrden(4);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    
        $entity = new Dependencia();
        $entity->setCodigo('NP');
        $entity->setOrden(5);
        $entity->setNombre('Nivel Primario');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    
        $entity = new Dependencia();
        $entity->setCodigo('NM');
        $entity->setOrden(6);
        $entity->setNombre('Nivel Medio');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    
        $entity = new Dependencia();
        $entity->setCodigo('SD_ANX');
        $entity->setOrden(3);
        $entity->setNombre('Sede/anexo');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    
        
    }

    public function getOrder() {
        return 170;
    }

}

?>
