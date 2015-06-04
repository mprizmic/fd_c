<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Model\CarreraUnidadOfertaHandler;

class UnidadOfertaFactory {

    public static function createHandler($type, $em) {
        $baseClass = 'UnidadOfertaHandler';
        $targetClass = ucfirst($type) . $baseClass . '.php';

        if (class_exists($targetClass)) {
            if (is_subclass_of($targetClass, $baseClass)) {
                return new $targetClass($em);
            }
        } else {
            throw new \Exception("No existe la clase '$type' .");
        }
    }

}
