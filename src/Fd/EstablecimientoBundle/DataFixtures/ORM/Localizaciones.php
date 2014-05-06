<?php

namespace Fd\EstablecimientoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EstablecimientoBundle\Entity\Localizacion;

class Localizaciones extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
        
        ////////////////ens 1
        $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 1 Ini')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 1 00')));
        
        $manager->persist($entity);
        $this->addReference('ENS 1 Ini 00', $entity);
        $manager->flush();
        
        $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 1 Pri')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 1 00')));
        
        $manager->persist($entity);
        $this->addReference('ENS 1 Pri 00', $entity);
        $manager->flush();
        
                $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 1 Med')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 1 00')));
        
        $manager->persist($entity);
        $this->addReference('ENS 1 Med 00', $entity);
        $manager->flush();
        
                $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 1 Ter')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 1 00')));
        
        $manager->persist($entity);
        $this->addReference('ENS 1 Ter 00', $entity);
        $manager->flush();
        ///////// fin ens 1
        
        ////////////////ens 8
        $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 8 Pri')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 8 01')));
        
        $manager->persist($entity);
        $this->addReference('ENS 8 Pri 01', $entity);
        $manager->flush();
        
        $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 8 Med')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 8 00')));
        
        $manager->persist($entity);
        $this->addReference('ENS 8 Med 00', $entity);
        $manager->flush();
        
                $entity = new Localizacion();
        $entity->setUnidadEducativa($manager->merge($this->getReference('ENS 8 Ter')));
        $entity->setEstablecimientoEdificio($manager->merge($this->getReference('ENS 8 00')));
        
        $manager->persist($entity);
        $this->addReference('ENS 8 Ter 00', $entity);
        $manager->flush();
                ///////// fin ens 8
    }
    public function getOrder() {
        return 400;
    }
}
?>
