<?php

/*
 * esta clase es el validador propiamente dicho de los campos que van a guardar la entrada de si_no_sd 
 * en reemplazo de los booleanos
 */

namespace Fd\EstablecimientoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SinosdValidator extends ConstraintValidator {

    private $si_no_sd;
    
    public function __construct( array $si_no_sd ){
        $this->si_no_sd = $si_no_sd;
    }
    
    public function validate($value, Constraint $constraint) {
        if ( !\array_key_exists($value , $this->si_no_sd )) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }

}