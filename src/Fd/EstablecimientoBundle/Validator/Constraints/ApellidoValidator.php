<?php
namespace Fd\EstablecimientoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ApellidoValidator extends ConstraintValidator
{
    public function validate( $value, Constraint $constraint)
    {
        if (0 === preg_match('/^[a-zA-Z \-\'üÜñÑáéíóúÁÉÍÓÚ]+$/',$value)){
            $this->context->addViolation($constraint->message);
        }
    }
}