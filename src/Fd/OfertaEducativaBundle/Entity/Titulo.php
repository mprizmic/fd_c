<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\TablaBundle\Entity\EstadoValidez;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;

/**
 * @ORM\Table(name="titulo")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\TituloRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Titulo {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=150, nullable=false)
     */
    private $nombre;
    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Carrera", inversedBy="titulos", cascade={"persist", "remove"})
     */
    private $carrera;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoCarrera")
     */
    private $estado;

    /**
     * lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoValidez")
     */
    private $estado_validez;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_estado_validez;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $validez_desde;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $validez_hasta;

    /**
     * registro historico de los estados por los que fue pasando la validez del titulo
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez", mappedBy="el_titulo")
     */
    private $estados_validez;
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
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion()
    {
        $this->setActualizado(new \DateTime());
    }     
    /**
     * @Assert\True(message="Si tiene cargado un estado, debe cargar la fecha correspondiente")
     */
    public function isValidezCargada(){
        if (count($this->estados_validez)>0) {
            if (empty($this->fecha_estado_validez)){
                return false;
            };
        };
        return true;
    }

    public function __toString() {
        return $this->nombre;
    }
    public function __construct() {
        $this->estados_validez = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();        
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
     * Set nombre
     *
     * @param string $nombre
     * @return Titulo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fecha_estado_validez
     *
     * @param \DateTime $fechaEstadoValidez
     * @return Titulo
     */
    public function setFechaEstadoValidez($fechaEstadoValidez)
    {
        $this->fecha_estado_validez = $fechaEstadoValidez;
    
        return $this;
    }

    /**
     * Get fecha_estado_validez
     *
     * @return \DateTime 
     */
    public function getFechaEstadoValidez()
    {
        return $this->fecha_estado_validez;
    }

    /**
     * Set validez_desde
     *
     * @param \DateTime $validezDesde
     * @return Titulo
     */
    public function setValidezDesde($validezDesde)
    {
        $this->validez_desde = $validezDesde;
    
        return $this;
    }

    /**
     * Get validez_desde
     *
     * @return \DateTime 
     */
    public function getValidezDesde()
    {
        return $this->validez_desde;
    }

    /**
     * Set validez_hasta
     *
     * @param \DateTime $validezHasta
     * @return Titulo
     */
    public function setValidezHasta($validezHasta)
    {
        $this->validez_hasta = $validezHasta;
    
        return $this;
    }

    /**
     * Get validez_hasta
     *
     * @return \DateTime 
     */
    public function getValidezHasta()
    {
        return $this->validez_hasta;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Titulo
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
     * @return Titulo
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
     * Set carrera
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $carrera
     * @return Titulo
     */
    public function setCarrera(\Fd\OfertaEducativaBundle\Entity\Carrera $carrera = null)
    {
        $this->carrera = $carrera;
    
        return $this;
    }

    /**
     * Get carrera
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Carrera 
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    /**
     * Set estado
     *
     * @param \Fd\TablaBundle\Entity\EstadoCarrera $estado
     * @return Titulo
     */
    public function setEstado(\Fd\TablaBundle\Entity\EstadoCarrera $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Fd\TablaBundle\Entity\EstadoCarrera 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set estado_validez
     *
     * @param \Fd\TablaBundle\Entity\EstadoValidez $estadoValidez
     * @return Titulo
     */
    public function setEstadoValidez(\Fd\TablaBundle\Entity\EstadoValidez $estadoValidez = null)
    {
        $this->estado_validez = $estadoValidez;
    
        return $this;
    }

    /**
     * Get estado_validez
     *
     * @return \Fd\TablaBundle\Entity\EstadoValidez 
     */
    public function getEstadoValidez()
    {
        return $this->estado_validez;
    }

    /**
     * Add estados_validez
     *
     * @param \Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez $estadosValidez
     * @return Titulo
     */
    public function addEstadosValidez(\Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez $estadosValidez)
    {
        $this->estados_validez[] = $estadosValidez;
    
        return $this;
    }

    /**
     * Remove estados_validez
     *
     * @param \Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez $estadosValidez
     */
    public function removeEstadosValidez(\Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez $estadosValidez)
    {
        $this->estados_validez->removeElement($estadosValidez);
    }

    /**
     * Get estados_validez
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstadosValidez()
    {
        return $this->estados_validez;
    }
}