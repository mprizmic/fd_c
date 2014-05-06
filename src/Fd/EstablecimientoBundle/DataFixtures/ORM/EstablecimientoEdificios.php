<?php

namespace Fd\EstablecimientoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;

class EstablecimientoEdificios extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
        $hoy = new \DateTime('today');
        
        $entity = new EstablecimientoEdificio();
        $entity->setCueAnexo('00');
        $entity->setNombre('Sede única');
        $entity->setFechaCreacion($hoy);
        $entity->setEstablecimientos($manager->merge($this->getReference('ENS 1')));
        $entity->setEdificios($manager->merge($this->getReference('123456789')));
        
        $manager->persist($entity);
        $this->addReference('ENS 1'.' '.$entity->getCueAnexo(), $entity);
        $manager->flush();

        //ens 8
        $entity = new EstablecimientoEdificio();
        $entity->setCueAnexo('00');
        $entity->setNombre('Sede La Rioja');
        $entity->setFechaCreacion($hoy);
        $entity->setEstablecimientos($manager->merge($this->getReference('ENS 8')));
        $entity->setEdificios($manager->merge($this->getReference('123456790')));
        
        $manager->persist($entity);
        $this->addReference('ENS 8'.' '.$entity->getCueAnexo(), $entity);
        $manager->flush();

        /// ens 8
        $entity = new EstablecimientoEdificio();
        $entity->setCueAnexo('01');
        $entity->setNombre('Sede Carlos Calvo');
        $entity->setFechaCreacion($hoy);
        $entity->setEstablecimientos($manager->merge($this->getReference('ENS 8')));
        $entity->setEdificios($manager->merge($this->getReference('123456791')));
        
        $manager->persist($entity);
        $this->addReference('ENS 8'.' '.$entity->getCueAnexo(), $entity);
        $manager->flush();
    }
    public function getOrder() {
        return 350;
    }
}
?>
