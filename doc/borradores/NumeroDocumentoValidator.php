<?php
namespace Sga\AlumnoBundle\lib;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Sga\AlumnoBundle\lib\NumeroDocumento;

class NumeroDocumentoValidator extends ConstraintValidator
{
    public function isValid( $value, Constraint $constraint)
    {
        if (0 === preg_match('/^[a-zA-Z0-9]{0,10}$/',$value)){
            $this->setMessage($constraint->message);
            return false;
        }
        return true;
    }
}