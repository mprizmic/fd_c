<?php
namespace Fd\EstablecimientoBundle\Twig\Extension;

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
    public function a_combo( $arreglo ) {
        $salida = "<select id=\"combo_norma\">";
        foreach ( $arreglo as $key => $value) {
            $salida = $salida . "<option value='" . $key . "'>" . 
                    $value['numero'] . "/" .  
                    $value['codigo'] . "/" .  
                    $value['anio'] . 
                    "</option>";
        }
        
        return $salida."</select>";
    }

}
