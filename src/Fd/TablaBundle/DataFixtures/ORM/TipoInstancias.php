<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\TipoInstancia;

class TipoInstancias extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new TipoInstancia();
        $entity->setCodigo('Tal');
        $entity->setDescripcion('Taller');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
              
        $entity = new TipoInstancia();
        $entity->setCodigo('Mat');
        $entity->setDescripcion('Materia');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
              
        $entity = new TipoInstancia();
        $entity->setCodigo('Sem');
        $entity->setDescripcion('Seminario');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

                $entity = new TipoInstancia();
        $entity->setCodigo('Tcp');
        $entity->setDescripcion('Trabajo de campo');
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
    }

    public function getOrder() {
        return 205;
    }
}
?>
