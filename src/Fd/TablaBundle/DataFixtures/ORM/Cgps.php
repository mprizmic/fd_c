<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Cgp;

class Cgps extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        for ($i=1;$i<17;$i++){
            $entity = new Cgp();
            $entity->setNumero($i);
            $manager->persist($entity);
            
            $this->addReference('cgp'.$i, $entity);
        }

        $manager->flush();
       
    }

    public function getOrder() {
        return 140;
    }
}
?>
