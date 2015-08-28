<?php

namespace Fd\EstablecimientoBundle\Utilities;

/**
 * Genera una URL desde los datos de la sesion
 */
class Destino {

    static public function generateUrlDesdeSession($session, $router) {

        //recupero la ruta a la cual hay que volver
        $ruta = $session->get('ruta_completa');
        $params = $session->get('parametros');

        return $router->generate($ruta, $params, false);
    }

    static public function guardarUrlDeRetorno($session, $request) {
        
        $this->get('session')->set('ruta_completa', $request->get('_route'));
        $this->get('session')->set('parametros', $request->get('_route_params'));
    }

}
