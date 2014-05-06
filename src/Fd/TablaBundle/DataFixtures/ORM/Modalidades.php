<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Modalidad;

class Modalidades extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $datos = array(
            array('nombre'=>'Común', 'abreviatura'=>'Cmn'),
            array('nombre'=>'Artística', 'abreviatura'=>'Art'),
            array('nombre'=>'Especial', 'abreviatura'=>'Esp'),
            array('nombre'=>'Jóvenes y adultos', 'abreviatura'=>'JyA')
            );

        foreach ($datos as $uno) {
            $entity = new Modalidad();
            $entity->setNombre($uno['nombre']);
            $entity->setAbreviatura($uno['abreviatura']);
            $manager->persist($entity);
            
            $this->addReference($entity->getAbreviatura(), $entity);
        }

        $manager->flush();
       
    }

    public function getOrder() {
        return 120;
    }
}
?>
