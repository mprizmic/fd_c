<?php

namespace Fd\EstablecimientoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;

class UnidadEducativas extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
        
        //inicial
        $entity = new UnidadEducativa();
        $entity->setDescripcion('inicial');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 1')));
        $entity->setNivel($manager->merge($this->getReference('Ini')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 1 Ini' , $entity);
        $manager->persist($entity);
        $manager->flush();        
        
        //primaria
        $entity = new UnidadEducativa();
        $entity->setDescripcion('primaria');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 1')));
        $entity->setNivel($manager->merge($this->getReference('Pri')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 1 Pri', $entity);
        $manager->persist($entity);
        $manager->flush();
        
        //media
        $entity = new UnidadEducativa();        
        $entity->setDescripcion('media');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 1')));
        $entity->setNivel($manager->merge($this->getReference('Med')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 1 Med', $entity);
        $manager->persist($entity);
        $manager->flush();
                
        //terciario
        $entity = new UnidadEducativa();                
        $entity->setDescripcion('terciario');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 1')));
        $entity->setNivel($manager->merge($this->getReference('Ter')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 1 Ter', $entity);
        $manager->persist($entity);
        $manager->flush();

/////////////////////////////////////////////////////////
        //////////////////////////////////////////////
        
        //primaria
        $entity = new UnidadEducativa();
        $entity->setDescripcion('primaria');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 8')));
        $entity->setNivel($manager->merge($this->getReference('Pri')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 8 Pri', $entity);
        $manager->persist($entity);
        $manager->flush();
        
        //media
        $entity = new UnidadEducativa();        
        $entity->setDescripcion('media');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 8')));
        $entity->setNivel($manager->merge($this->getReference('Med')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 8 Med', $entity);
        $manager->persist($entity);
        $manager->flush();
                
        //terciario
        $entity = new UnidadEducativa();                
        $entity->setDescripcion('terciario');
        $entity->setEstablecimiento($manager->merge($this->getReference('ENS 8')));
        $entity->setNivel($manager->merge($this->getReference('Ter')));
        $entity->setModalidad($manager->merge($this->getReference('Cmn')));

        $this->setReference('ENS 8 Ter', $entity);
        $manager->persist($entity);
        $manager->flush();
        
    }
    public function getOrder() {
        return 250;
    }
}
?>
