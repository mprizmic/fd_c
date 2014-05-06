<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Dia;

class Dias extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {

        $entity = new Dia();
        $entity->setCodigo('DOM');
        $entity->setDescripcion('Domingo');
        $entity->setOrden(1);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
              
        $entity = new Dia();
        $entity->setCodigo('LUN');
        $entity->setDescripcion('Lunes');
        $entity->setOrden(2);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Dia();
        $entity->setCodigo('MAR');
        $entity->setDescripcion('Martes');
        $entity->setOrden(3);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

                $entity = new Dia();
        $entity->setCodigo('MIE');
        $entity->setDescripcion('Miércoles');
        $entity->setOrden(4);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

                $entity = new Dia();
        $entity->setCodigo('JUE');
        $entity->setDescripcion('Jueves');
        $entity->setOrden(5);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

                $entity = new Dia();
        $entity->setCodigo('VIE');
        $entity->setDescripcion('Viernes');
        $entity->setOrden(6);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

                $entity = new Dia();
        $entity->setCodigo('SAB');
        $entity->setDescripcion('Sábado');
        $entity->setOrden(7);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

    }

    public function getOrder() {
        return 3000;
    }
}
?>
