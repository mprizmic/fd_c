<?php

namespace Sga\AlumnoBundle\lib;

use Symfony\Component\Validator\Constraint;
use Sga\AlumnoBundle\lib\NumeroDocumentoValidator;

/**
 * @Annotation
 */
class NumeroDocumento extends Constraint
{
    public $message = "El número de documento sólo puede tener caracteres alfanuméricos";
}
