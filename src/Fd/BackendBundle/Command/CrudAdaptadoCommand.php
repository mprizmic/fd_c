<?php

/*
 * este fuente está extendido del original de SF2.0.17
 *
 * se usa app/console b:g:c Bundle:Entity
 */

namespace Fd\BackendBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;

class CrudAdaptadoCommand extends GenerateDoctrineCrudCommand {

    protected $generator;

    protected function configure() {
        parent::configure();
        $this->setName('backend:generate:crud');
        $this->setDescription('Generador de Crud modificado del original de SF2.0.17');
    }

    protected function getGenerator() {
        if (null === $this->generator) {
            $this->generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__ . '/../Resources/skeleton/crud');
        }

        return $this->generator;
    }
}