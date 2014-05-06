<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Nivel;

class Niveles extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $datos = array(
            array('nombre'=>'Inicial', 'abreviatura'=>'Ini', 'orden'=>1),
            array('nombre'=>'Primario', 'abreviatura'=>'Pri', 'orden'=>2),
            array('nombre'=>'Medio', 'abreviatura'=>'Med', 'orden'=>3),
            array('nombre'=>'Terciario', 'abreviatura'=>'Ter', 'orden'=>4)
            );

        foreach ($datos as $uno) {
            $entity = new Nivel();
            $entity->setNombre($uno['nombre']);
            $entity->setAbreviatura($uno['abreviatura']);
            $entity->setOrden($uno['orden']);
            $manager->persist($entity);
            
            $this->addReference($entity->getAbreviatura(), $entity);
        }

        $manager->flush();
       
    }

    public function getOrder() {
        return 110;
    }
}
?>
