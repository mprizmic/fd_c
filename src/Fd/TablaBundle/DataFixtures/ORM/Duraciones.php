<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Duracion;

class Duraciones extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Duracion();
        $entity->setCodigo('C');
        $entity->setDescripcion('Cuatrimestral');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new Duracion();
        $entity->setCodigo('A');
        $entity->setDescripcion('Anual');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

    }

    public function getOrder() {
        return 195;
    }
}
?>
