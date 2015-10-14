<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Fd\TablaBundle\Entity\Nivel;

/**
 * Fd\EstablecimientoBundle\Entity\UnidadEducativa
 *
 * @ORM\Table(name="unidad_educativa")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\UnidadEducativaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class UnidadEducativa {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=30, nullable=true)
     */
    private $descripcion;

    /**
     * @var Establecimiento
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Establecimiento", inversedBy="unidades_educativas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })
     */
    private $establecimiento;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\Localizacion", mappedBy="unidad_educativa")
     */
    private $localizaciones;
    
    /**
     * @var Nivel
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nivel_id", referencedColumnName="id")
     * })
     */
    private $nivel;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $actualizado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;

    /**
     * Devuelve un array con codigo y descripcion del nivel
     * @return type
     */
    public function aJson(){
        
        $resultado['value'] = $this->getId();
        $resultado['text'] = $this->getNivel()->getNombre();

        return $resultado;
    }
    /**
     * FALTA este se modifica por 'ofertas'
     * Al cambiar la relacion de ofertas de unidad educativa a localizaciones esto se modifica. No existe más getOfertas()
     * 
     * Devuelve un array con las ofertas de un determinado nivel o unidad academica
     * Si no hay oferta para un nivel determinado devuelve NULL
     * 
     * @return null
     */
    public function existeOferta() {
        $ofertas = array(); //$this->getOfertas();
        if (count($ofertas) > 0) {
            return $ofertas;
        } else {
            return null;
        };
    }

    public function __toString() {
        return  $this->getEstablecimiento(). '/' .  $this->getNivel()->getNombre();
    }

    /*
     * Determina si la unidad educativa tiene cargada oferta de inicial
     */

    public function isInicial() {
        return $this->queNivel() == 'Ini';
    }

    /*
     * verifica el nivel de la unidad educativa
     * Devuelve un string con la abreviatura del nivel
     */

    public function queNivel() {
        return $this->getNivel()->getAbreviatura();
    }

    public function isTerciario() {
        return $this->queNivel() == 'Ter';
    }

//
//    public function setTurnos(\Doctrine\Common\Collections\Collection $turnos) {
//        foreach ($turnos as $turno_unidad_educativa) {
//            $turno_unidad_educativa->addUnidadEducativa($this);
//        }
//        $this->turnos = $turnos;
//    }
    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion()
    {
        $this->setActualizado(new \DateTime());
    }
    /**
     * esta la escribí yo, no es automática
     */
    public function setTurnos(ArrayCollection $turnos) {
        $this->turnos = $turnos;
        foreach ($turnos as $turno_unidad_educativa) {
            $turno_unidad_educativa->setUnidadEducativa($this);
        }
    }

    public function __construct() {

        $this->turnos = new ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
    }

 }
