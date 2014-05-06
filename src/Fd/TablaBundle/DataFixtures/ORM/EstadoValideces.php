<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\EstadoValidez;

class EstadoValideces extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new EstadoValidez();
        $entity->setCodigo('P');
        $entity->setDescripcion('P');
        $entity->setOrden(1);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
    }

    public function getOrder() {
        return 231;
    }
}
?>
