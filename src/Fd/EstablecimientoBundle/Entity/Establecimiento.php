<?php

namespace Fd\EstablecimientoBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\EstablecimientoBundle\Validator\Constraints as FdAssert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fd\EstablecimientoBundle\Entity\Establecimiento
 *
 * @ORM\Table(name="establecimiento")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\EstablecimientoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Establecimiento {

    const ETIQUETA = 'Establecimiento';
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $cue
     *
     * @ORM\Column(name="cue", type="string", length=7, nullable=true)
     */
    private $cue;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio", mappedBy="establecimientos")
     * 
     */
    private $edificio;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\TipoEstablecimiento")
     */
    private $tipo_establecimiento;

    /**
     *
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $codigo_previo_transferencia;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(length=25, nullable=true)
     */
    private $apodo;

    /**
     * @var string $numero
     *
     * @ORM\Column(name="numero", type="integer", length=2, nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(name="orden", type="integer", length=2, nullable=true)
     */
    private $orden;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=15, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)        
     * La longitud se la chequea en isFecha
     */
    private $fecha_creacion;

    /**
     *
     * @ORM\Column(name="tiene_cooperadora", type="string", length=2, nullable=true)
     * @FdAssert\Sinosd
     */
    private $tiene_cooperadora;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\DistritoEscolar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrito_escolar_id", referencedColumnName="id")
     * })
     */
    private $distrito_escolar;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Sector")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sector_id", referencedColumnName="id")
     * })
     */
    private $sector;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadEducativa", mappedBy="establecimiento")
     */
    private $unidades_educativas;

    /**
     * domicilio del campo de deportes
     * @ORM\Column(nullable=true, length=25)
     */
    private $campo_deportes;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_presentacion_roi;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_roi;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_presentacion_rai;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_rai;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_presentacion_rp;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_rp;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_elecciones;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fin_mandato;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\Column(length=4)
     */
    private $anio_inicio_nes;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso", mappedBy="establecimiento")
     * 
     */
    private $recursos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $actualizado;

    /**
     * recuprea el edificio principal que tiene anexo 00. Es un objeto establecimiento_edificio No se si dedería estar sólo en el repository
     * 
     * @return type
     */
    public function getEdificioPrincipal() {
        $el_principal = null;
        foreach ($this->getEdificio() as $un_edificio) {
            if ($un_edificio->getCueAnexo() == '00') {
                $el_principal = $un_edificio;
                break;
            }
        };
        return $el_principal;
    }

    /**
     * DEPRECATED en la localizacion de la oferta
     * 
     * Verifica si un establecimiento tiene la carrera asignada
     * @param type $carrera
     * @return boolean
     */
//    public function hasCarrera($carrera) {
//        $unidad_ofertas = $this->getUnidadEducativa('Ter')->getOfertas();
//        $oferta_educativa = $carrera->getOferta();
//        foreach ($unidad_ofertas as $unidad_oferta) {
//            if ($unidad_oferta->getOfertas()->getId() == $oferta_educativa->getId()) {
//                return true;
//            }
//        }
//        return false;
//    }

    /**
     * Toma la comuna del edificio principal del establecimiento
     * 
     */
    public function getComuna() {
        $comuna = $this->getEdificioPrincipal()->getEdificios()->getComuna();
        return $comuna;
    }

    /**
     * Toma el CGP del edificio principal del establecimiento
     * 
     */
    public function getCgp() {

        return $this->getEdificioPrincipal()->getEdificios()->getCgp();
    }

    /**
     * devuelve la unidad educativa de nivel terciario
     * @return type
     */
    public function getTerciario() {
        foreach ($this->getUnidadesEducativas() as $unidad) {
            if ($unidad->isTerciario()) {
                return $unidad;
            }
        };
    }

    /**
     * 
     * @param type $nivel Es un string con la abreviatura del nivel
     * @return null 
     */
    public function getUnidadEducativa($nivel) {
        foreach ($this->getUnidadesEducativas() as $unidad) {
            if ($unidad->getNivel()->getAbreviatura() == $nivel) {
                return $unidad;
            }
        };
        return null;
    }

    /**
     * Devuelve el no de anexo más alto que esté registrado
     * @return type
     */
    public function getMayorAnexo() {
        //tomo la colección de edificios y le busco el de mayor # de anexo
        $anexos = $this->getEdificio();
        $max = "00";
        foreach ($anexos as $establecimiento_edificio) {
            $este = $establecimiento_edificio->getCueAnexo();
            if ($este > $max) {
                $max = $este;
            };
        };
        return $max;
    }

    /**
     * Al mayor nro de anexo que esté registrado le suma 1
     * Devuelve una sarta de 2 caracteres con "0" a la izquierda
     * 
     * @return type
     */
    public function getNroNuevoAnexo() {
        $max = $this->getMayorAnexo();
        //le sumo 1 al mayor nro de anexo existente
        $max = substr(str_pad(strval($max + 1), 3, "0", STR_PAD_LEFT), 1, 2);
        return $max;
    }

    /**
     * Verifica si un valor dado ya está siendo usado como nro de anexo
     * 
     * @param type $valor
     */
    public function esAnexo($valor) {
        $anexos = $this->getEdificio();
        foreach ($anexos as $establecimiento_edificio) {
            $anexo = $establecimiento_edificio->getCueAnexo();
            if ($anexo == $valor)
                return true;
        };
        return false;
    }

    public function __toString() {
        return $this->getApodo();
    }

    /**
     * Chequea si la fecha de creación tiene formato de fecha
     * @Assert\True(message="La fecha de creación no tiene formato válido")
     */
    public function isFecha() {

        //esta asignacion se hace por un problema del empty de php
        $la_fecha = $this->fecha_creacion;

        if (empty($la_fecha)) {

            //si está vacía no se chequea el formato nila longitud
            return true;
        } else {
            if (strlen($la_fecha) > 0 and strlen($la_fecha) == 10) {
                return ( preg_match("/([0-9]{2})\-([0-9]{2})-([0-9]{4})/i", $this->fecha_creacion) ) ?
                        checkdate(substr($this->fecha_creacion, 3, 2), substr($this->fecha_creacion, 0, 2), substr($this->fecha_creacion, 6, 4)) :
                        false;
            } else {
                return false;
            }
        }
    }
    public function getRector(){
        $resultado = null;
        return $resultado;
        
    }

    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion() {
        $this->setActualizado(new \DateTime());
    }

    public function __construct() {
        $this->edificio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
    }
}
