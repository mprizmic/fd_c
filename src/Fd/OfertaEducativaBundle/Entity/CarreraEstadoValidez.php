<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Table(name="carrera_estado_validez")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\CarreraEstadoValidezRepository")
 */
class CarreraEstadoValidez {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * bidireccional lado propietario
     * 
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Carrera", inversedBy="estados_validez")
     * @ORM\JoinColumn(name="carrera_id", referencedColumnName="id")
     */
    private $la_carrera;

    /**
     * Es el dato copiado de la tabla Carrera. Corresponde al estado anterior al actual
     * 
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoValidez")
     */
    private $estado_validez;

    /**
     * Es el dato copiado de la tabla Carrera
     * 
     * @ORM\Column(type="date", nullable=true)
     * 
     */
    private $fecha_estado_validez;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @return type
     */
    private $createdAt;

    public function __toString() {
        return $this->estado_validez . ' ' . $this->fecha_estado_validez;
    }
    public function __construct(Carrera $carrera = null) {
        if (!is_null($carrera)){
            $this->la_carrera = $carrera;
            $this->estado_validez = $carrera->getEstadoValidez();
            $this->fecha_estado_validez = $carrera->getFechaEstadoValidez();
            $this->validez_desde = $carrera->getValidezDesde();
            $this->validez_hasta = $carrera->getValidezHasta();
        };
        $this->createdAt = new \DateTime('now');
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
     * Set fecha_estado_validez
     *
     * @param date $fechaEstadoValidez
     */
    public function setFechaEstadoValidez($fechaEstadoValidez)
    {
        $this->fecha_estado_validez = $fechaEstadoValidez;
    }

    /**
     * Get fecha_estado_validez
     *
     * @return date 
     */
    public function getFechaEstadoValidez()
    {
        return $this->fecha_estado_validez;
    }

    /**
     * Set validez_desde
     *
     * @param date $validezDesde
     */
    public function setValidezDesde($validezDesde)
    {
        $this->validez_desde = $validezDesde;
    }

    /**
     * Get validez_desde
     *
     * @return date 
     */
    public function getValidezDesde()
    {
        return $this->validez_desde;
    }

    /**
     * Set validez_hasta
     *
     * @param date $validezHasta
     */
    public function setValidezHasta($validezHasta)
    {
        $this->validez_hasta = $validezHasta;
    }

    /**
     * Get validez_hasta
     *
     * @return date 
     */
    public function getValidezHasta()
    {
        return $this->validez_hasta;
    }

    /**
     * Set la_carrera
     *
     * @param Fd\OfertaEducativaBundle\Entity\Carrera $laCarrera
     */
    public function setLaCarrera(\Fd\OfertaEducativaBundle\Entity\Carrera $laCarrera)
    {
        $this->la_carrera = $laCarrera;
    }

    /**
     * Get la_carrera
     *
     * @return Fd\OfertaEducativaBundle\Entity\Carrera 
     */
    public function getLaCarrera()
    {
        return $this->la_carrera;
    }

    /**
     * Set estado_validez
     *
     * @param Fd\TablaBundle\Entity\EstadoValidez $estadoValidez
     */
    public function setEstadoValidez(\Fd\TablaBundle\Entity\EstadoValidez $estadoValidez)
    {
        $this->estado_validez = $estadoValidez;
    }

    /**
     * Get estado_validez
     *
     * @return Fd\TablaBundle\Entity\EstadoValidez 
     */
    public function getEstadoValidez()
    {
        return $this->estado_validez;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CarreraEstadoValidez
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}