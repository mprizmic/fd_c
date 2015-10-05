<?php

namespace Fd\EstablecimientoBundle\Model;

class ConstantesTests {

    const CARRERA_PROFESORADO_DE_INICIAL = 71;
    const CARRERA_PROFESORADO_DE_PRIMARIA = 72;
    const NORMA_PROFESORADO_DE_PRIMARIA = 157;
    const CARRERA_PROFESORADO_CIENCIA_POLITICA = 84;
    const LOCALIZACION_JOAQUIN = 96;
    const CARRERAS_JOAQUIN = 21;
    const LOCALIZACION_ENS3_ST = 97;
    const LOCALIZACION_ENS3_VL = 88;
    const CANTIDAD_TERCIARIOS = 25;
    const ENS3 = 18;
    const ENS3_ST_PEI = 262;
    const UNIDAD_OFERTA_ENS_7 = 288;
    const OFERTA_CIENCIA_JURIDICA = 93;
    
    
    const ACTIVA = 1;
    const INACTIVA = 2;

    const CANTIDAD_TOTAL_CARRERAS = 57;
    const CANTIDAD_TOTAL_CARRERAS_ACTIVAS = 52;
    
    private $constants;
    private $constantKeys;

    /**
     * Por reflection obtengo la lista de constantes de la clase y las
     * agrega a un array privado a nivel del objeto al momento de instanciarse el objeto
     */
    public function __construct() {

        $class = new \ReflectionClass(__CLASS__);
        $this->constants = $class->getConstants();
        $this->constantKeys = array_keys($this->constants);
    }

    /**
     * Al momento de invocarse a la constante, PHP interpreta que debería ser una
     * propiedad pública del objeto y como efectivamente no existe, se llama al método
     * __isset para que nosotros decidamos si existe o no. Lo que hacemos es fijarnos
     * si el nombre de la constante que es invocada existe dentro de nuestro array de
     *  constantes descubiertas por reflection
     */
    public function __isset($name) {
        if (in_array($name, $this->constantKeys)) {
            return true;
        }
        return false;
    }

    /**
     * Cuando el método __isset devuelve true, entra al método __get y devuelve
     * el valor de la constante
     */
    public function __get($name) {
        if (in_array($name, $this->constantKeys)) {
            return $this->constants[$name];
        }
        return null;
    }

}
