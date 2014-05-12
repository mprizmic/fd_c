<?php

namespace Fd\EstablecimientoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Apellido extends Constraint {

    public $message = "El apellido sólo puede contener caracteres alfabéticos sin acentos";

    public function validatedBy() {
        return 'apellido_alfabetico';
    }

}
