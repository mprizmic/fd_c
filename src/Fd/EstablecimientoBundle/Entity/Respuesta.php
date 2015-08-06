<?php

namespace Fd\EstablecimientoBundle\Entity;

/**
 * usado para devolver mensajes en el proceso de creacion/actualiacion
 */
class Respuesta {

    protected $codigo;
    protected $mensaje;
    protected $clave_nueva;
    protected $obj_nuevo;

    public function __construct($codigo = null, $mensaje = null) {
        if (!$codigo) {
            $this->codigo = 2; //se carga error por default
        } else {
            $this->codigo = $codigo;
        }

        if (!$mensaje) {
            $this->mensaje = 'No se pudo concreatar la operación. Verifique y reintente';
        } else {
            $this->mensaje = $mensaje;
        }
        
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setClaveNueva($clave_nueva) {
        $this->clave_nueva = $clave_nueva;
    }

    public function getClaveNueva() {
        return $this->clave_nueva;
    }
    public function setObjNuevo($obj_nuevo) {
        $this->obj_nuevo = $obj_nuevo;
    }

    public function getObjNuevo() {
        return $this->obj_nuevo;
    }

}