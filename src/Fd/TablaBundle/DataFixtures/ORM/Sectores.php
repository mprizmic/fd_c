<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Sector;

class Sectores extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $datos = array(
            array('descripcion'=>'Estatal', 'abreviatura'=>'E'),
            array('descripcion'=>'Público', 'abreviatura'=>'P'),
            array('descripcion'=>'Mixto', 'abreviatura'=>'M')
            );

        foreach ($datos as $uno) {
            $entity = new Sector();
            $entity->setDescripcion($uno['descripcion']);
            $entity->setAbreviatura($uno['abreviatura']);
            $manager->persist($entity);
            
            $this->addReference($entity->getDescripcion(), $entity);
        }

        $manager->flush();
       
    }

    public function getOrder() {
        return 100;
    }
}
?>
