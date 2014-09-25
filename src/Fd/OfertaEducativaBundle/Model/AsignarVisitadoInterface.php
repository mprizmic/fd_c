<?php

/**
 * Interface para el Manager que es visitado para asignar una entity manejada por el manejador a un establecimiento
 */
namespace Fd\OfertaEducativaBundle\Model;

use Fd\OfertaEducativaBundle\Model\AsignarVisitadorInterface;

interface AsignarVisitadoInterface {

    public function accept(AsignarVisitadorInterface $visitador);
}
