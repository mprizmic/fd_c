<?php

/*
 * esta clase es el validador del custom fiel type que reemplaza a los campos booleanos
 */

namespace Fd\EstablecimientoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Sinosd extends Constraint {

    public $message = 'El valor "%string%" seleccionado es inválido';

    public function validatedBy() {
        return 'si_no_sd_validator';
    }

}
