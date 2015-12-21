<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitadoInterface;

interface DatosAChoiceVisitadorInterface {

    public function visitEstablecimientoEdificio(DatosAChoiceVisitadoInterface $visitado);
    public function visitDependencia(DatosAChoiceVisitadoInterface $visitado);
    public function visitCargo(DatosAChoiceVisitadoInterface $visitado);
    
}
