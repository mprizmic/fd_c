<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Model\CarreraUnidadOfertaHandler;
use Fd\EstablecimientoBundle\Model\InicialUnidadOfertaHandler;

class UnidadOfertaFactory {

    public static function createHandler($type, $em) {
        $baseClass = 'UnidadOfertaHandler';
        $targetClass = __NAMESPACE__. '\\' . $type . $baseClass;
        
        if (class_exists($targetClass)) {
            if (is_subclass_of($targetClass, __NAMESPACE__ . '\\' . $baseClass)) {
                return new $targetClass($em);
            }
        } else {
            throw new \Exception("No existe la clase '$type' .");
        }
    }

}
