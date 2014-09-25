<?php

namespace Fd\OfertaEducativaBundle\Model;

use Fd\OfertaEducativaBundle\Model\AsignarVisitadoInterface;

interface AsignarVisitadorInterface {

    public function visitCarrera(AsignarVisitadoInterface $visitado);
    public function visitEspecializacion(AsignarVisitadoInterface $visitado);
    
}
