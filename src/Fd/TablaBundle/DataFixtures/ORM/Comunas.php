<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Comuna;

class Comunas extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        for ($i=1;$i<17;$i++){
            $entity = new Comuna();
            $entity->setNumero($i);
            $manager->persist($entity);
            
            $this->addReference('comuna'.$i, $entity);
        }

        $manager->flush();
       
    }

    public function getOrder() {
        return 150;
    }
}
?>
