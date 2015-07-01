<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Model\CarreraUnidadOfertaHandler;
use Fd\EstablecimientoBundle\Model\InicialUnidadOfertaHandler;
use Fd\EstablecimientoBundle\Utilities\TipoUnidadOferta;

class UnidadOfertaFactory {

    public static function createHandler($type, $em) {
        $baseClass = 'UnidadOfertaHandler';
        $targetClass = __NAMESPACE__ . '\\' . $type . $baseClass;

        if (class_exists($targetClass)) {
            if (is_subclass_of($targetClass, __NAMESPACE__ . '\\' . $baseClass)) {
                return new $targetClass($em);
            }
        } else {
            throw new \Exception("No existe la clase '$type' .");
        }
    }

    /**
     * calcula las rutas a donde derivar cada unidad oferta para cada tipo que se presente
     * 
     * @param type $tipo
     * @param type $unidad_oferta
     * @param type $router
     */
    public static function createRutaEdit(UnidadOferta $unidad_oferta, $ruteador) {

        // tipo de oferta al que se requiere redirigir
        $tipo = $unidad_oferta->getTipo();

        // recupero el objeto de la clase que corresponda según el tipo y la unidad oferta
        $entity = $unidad_oferta->getOfertas()->getObjetoOferta();

        $nombre = 'backend_unidadoferta';
        $params = array();

        switch ($tipo) {
            case TipoUnidadOferta::TUO_CARRERA:
                $nombre = 'carrera_editar';
                $params['id'] = $entity->getId();
                break;
            case TipoUnidadOferta::TUO_PRIMARIO:
                $nombre = 'primario_nomina';
                break;
            case TipoUnidadOferta::TUO_INICIAL:
                break;
            case TipoUnidadOferta::TUO_BACHILLERATO:
                break;
            default :
        }

        $ruta_generada = $ruteador->generate($nombre, $params, false);

        return $ruta_generada;
    }

}
