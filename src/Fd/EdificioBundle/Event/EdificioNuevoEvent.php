<?php

namespace Fd\EdificioBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Fd\EdificioBundle\Entity\Edificio;

class EdificioNuevoEvent extends Event {

    protected $edificio;

    public function __construct(Edificio $edificio) {
        $this->edificio = $edificio;
    }

    public function getEdificio() {
        return $this->edificio;
    }

}