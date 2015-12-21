<?php

/**
 * Interface para el Manager que es visitado para asignar una entity manejada por el manejador a un establecimiento
 */
namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Model\Sedes;

interface DatosAChoiceVisitadoInterface {

    public function acceptDatosAChoice(DatosAChoiceVisitadorInterface $visitador);
}
