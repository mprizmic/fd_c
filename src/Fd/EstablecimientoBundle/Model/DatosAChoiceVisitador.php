<?php

/**
 * Esta clase responde a un pattern visitor
 * Visita al manager de carrera para asignar una carrera a un establecimiento
 * Lo mismo para Especializacion
 * 
 */

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitadoInterface;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitadorInterface;
use Fd\EstablecimientoBundle\Repository\EstablecimientoEdificioRepository;
use Fd\TablaBundle\Repository\DependenciaRepository;
use Fd\TablaBundle\Repository\CargoRepository;

class DatosAChoiceVisitador implements DatosAChoiceVisitadorInterface {

    /**
     * Podría tener cualquier estructura
     */
    protected $data;

    /**
     * El visitado puede o no pasarle datos necesarios para la asignacion
     * @param type $data
     */
    public function __construct($data = null) {
        $this->data = $data;
    }

    /**
     * Visita a establecimeinto_edificio para pasar la Collection que devuelve qbSedesYAnexos a un array con el formato predeterminado
     * @param EstablecimientoBundle\Repository\EstablecimientoEdificioRepository $visitado Description
     * @return type
     */
    public function visitEstablecimientoEdificio(DatosAChoiceVisitadoInterface $visitado) {
        
        $sedes_y_anexos = $visitado->findSedesYAnexosOrdenados();
        
        foreach ($sedes_y_anexos as $key => $value) {
            $resultado[$value->getId()] = $value->getEstablecimientos()->getApodo() . ($value->getCueAnexo() <> "00" ? ' - ' . $value->getNombre():"");
        };

        return $resultado;
    }
    /**
     * Visita a dependencia para pasar la Collection que devuelve un query a un array con el formato predeterminado
     * @param TablaBundle\Repository\DependenciaRepository $visitado Description
     * @return type
     */
    public function visitDependencia(DatosAChoiceVisitadoInterface $visitado) {
        $dependencias = $visitado->findAllOrdenado();
        
        foreach ($dependencias as $key => $value){
            $resultado[$value->getId()] = $value->getNombre();
        }
        
        return $resultado;
    }
    /**
     * Visita a cargo para pasar la Collection que devuelve un query a un array con el formato predeterminado
     * @param TablaBundle\Repository\CargoRepository $visitado Description
     * @return type
     */
    public function visitCargo(DatosAChoiceVisitadoInterface $visitado) {
        $cargos = $visitado->findAllOrdenado();

        foreach ($cargos as $key => $value){
            $resultado[$value->getId()] = $value->getNombre();
        }        
        
        return $cargos;
    }

}
