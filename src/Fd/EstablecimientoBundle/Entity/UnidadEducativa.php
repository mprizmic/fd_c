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
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\CargoAutoridad")
     */
    private $cargo_autoridad;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nombre_autoridad;
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
        return  $this->getEstablecimiento(). '/' .  $this->getNivel();
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

    public function getAutoridad() {
        return $this->cargo_autoridad . ' ' . $this->nombre_autoridad;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return UnidadEducativa
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set nombre_autoridad
     *
     * @param string $nombreAutoridad
     * @return UnidadEducativa
     */
    public function setNombreAutoridad($nombreAutoridad)
    {
        $this->nombre_autoridad = $nombreAutoridad;

        return $this;
    }

    /**
     * Get nombre_autoridad
     *
     * @return string 
     */
    public function getNombreAutoridad()
    {
        return $this->nombre_autoridad;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return UnidadEducativa
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime 
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return UnidadEducativa
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime 
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Set establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento
     * @return UnidadEducativa
     */
    public function setEstablecimiento(\Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento = null)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Fd\EstablecimientoBundle\Entity\Establecimiento 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Add localizaciones
     *
     * @param \Fd\EstablecimientoBundle\Entity\Localizacion $localizaciones
     * @return UnidadEducativa
     */
    public function addLocalizacione(\Fd\EstablecimientoBundle\Entity\Localizacion $localizaciones)
    {
        $this->localizaciones[] = $localizaciones;

        return $this;
    }

    /**
     * Remove localizaciones
     *
     * @param \Fd\EstablecimientoBundle\Entity\Localizacion $localizaciones
     */
    public function removeLocalizacione(\Fd\EstablecimientoBundle\Entity\Localizacion $localizaciones)
    {
        $this->localizaciones->removeElement($localizaciones);
    }

    /**
     * Get localizaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalizaciones()
    {
        return $this->localizaciones;
    }

    /**
     * Set nivel
     *
     * @param \Fd\TablaBundle\Entity\Nivel $nivel
     * @return UnidadEducativa
     */
    public function setNivel(\Fd\TablaBundle\Entity\Nivel $nivel = null)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return \Fd\TablaBundle\Entity\Nivel 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set cargo_autoridad
     *
     * @param \Fd\TablaBundle\Entity\CargoAutoridad $cargoAutoridad
     * @return UnidadEducativa
     */
    public function setCargoAutoridad(\Fd\TablaBundle\Entity\CargoAutoridad $cargoAutoridad = null)
    {
        $this->cargo_autoridad = $cargoAutoridad;

        return $this;
    }

    /**
     * Get cargo_autoridad
     *
     * @return \Fd\TablaBundle\Entity\CargoAutoridad 
     */
    public function getCargoAutoridad()
    {
        return $this->cargo_autoridad;
    }
}
