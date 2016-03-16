<?php

namespace Fd\EstablecimientoBundle\Model;

class Constantes {

    const NOMBRE = 'Sistema de Información de la Dirección de Formación Docente';
    const NOMBRE_CORTO = 'DFD';
    const VERSION_LOGICA = 'Versión 5 - 22.12.2015';
    const CREDITOS = 'Créditos: Marcelo Prizmic';
    const VERSION_SYMFONY = 'Symfony 2.1.13';
    const VERSION_DOCTRINE = 'Doctrine >=2.2.3,<2.5-dev';
    const VERSION_APACHE = '';
    const VERSION_MYSQL = '';
    const VERSION_FIREFOX = '';
    const DEPENDENCIA = 'Dirección de Formación Docente';
    const EMAIL = 'dfd@bue.edu.ar';
    const SITIO_WEB = 'http://www.buenosaires.gob.ar/educacion/estudiantes/terciario/formacion-docente';

    //referidas al tipo de unidad oferta
    const TUO_INICIAL = "Inicial";
    const TUO_PRIMARIO = "Primario";
    const TUO_BACHILLERATO = "Bachillerato";
    const TUO_SECUNDARIO = "Secundario";
    const TUO_CARRERA = "Carrera";
    const TUO_ESPECIALIZACION = "Especializacion";
    
    const ESTADO_CARRERA_ACTIVA = "ACT";

    const CUE_SEDE = '00';
    
    const GRILLA_MEDIANO = 15;
    
    public $TELEFONOS = array(
        array(
            'oficina' => 'Secretaría Privada',
            'te' => '4339-1892 / 1889 / 1887',
        ),
        array(
            'oficina' => 'Conmutador Esmeralda',
            'te' => '4339-1700',
        ),
    );
    
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
