<?php

namespace Fd\EstablecimientoBundle\Twig\Extension;

use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\Inicial;

class UtilidadesExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'ksort_cohortes' => new \Twig_Filter_Method($this, 'ksort_cohortes'),
            'a_combo' => new \Twig_Filter_Method($this, 'a_combo'),
        );
    }

    public function getName() {
        return 'utilidades';
    }

    public function ksort_cohortes($objeto_cohortes) {
        foreach ($objeto_cohortes as $value => $key) {
            $arr[$key->getAnio()] = array($key->getAnio(), $key->getMatriculaIngresantes(), $key->getMatricula(), $key->getEgreso());
        }
        ksort($arr);
        return $arr;
    }

    public function a_combo($arreglo) {
        $salida = "<select id=\"combo_norma\">";
        foreach ($arreglo as $key => $value) {
            $salida = $salida . "<option value='" . $key . "'>" .
                    $value['numero'] . "/" .
                    $value['codigo'] . "/" .
                    $value['anio'] .
                    "</option>";
        }

        return $salida . "</select>";
    }

    public function getTests() {
        return array(
            'instancia_de_carrera' =>  new \Twig_Test_Method($this, 'isCarrera') ,
            'instancia_de_inicial' =>  new \Twig_Test_Method($this, 'isInicial') ,
            'instancia_de_unidad_oferta' =>  new \Twig_Test_Method($this, 'isUnidadOferta') ,
            );
    }

    public function isUnidadOferta($var){
        return ($var instanceof UnidadOferta);
    }
    public function isCarrera($var) {
        return ($var instanceof Carrera);
    }
    public function isInicial($var){
        return ($var instanceof Inicial);
    }

}
