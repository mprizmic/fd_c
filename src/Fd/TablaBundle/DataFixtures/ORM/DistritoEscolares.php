<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\DistritoEscolar;

class DistritoEscolares extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        for ($i=1;$i<22;$i++){
            $entity = new DistritoEscolar();
            $entity->setNumero($i);
            $entity->setNombre($i);
            $manager->persist($entity);
            
            $this->addReference('distrito'.$i, $entity);
        }

        $manager->flush();
       
    }

    public function getOrder() {
        return 130;
    }
}
?>
