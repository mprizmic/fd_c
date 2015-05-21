<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;

/**
 * @ORM\Table(name="titulo_carrera")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\TituloCarreraRepository")
 * @ORM\HasLifecycleCallbacks
 */
class TituloCarrera {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=150, nullable=false, unique=true)
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
//    /**
//     * @Assert\True(message="Si tiene cargado un estado, debe cargar la fecha correspondiente")
//     */
//    public function isValidezCargada(){
//        if (count($this->estados_validez)>0) {
//            if (empty($this->fecha_estado_validez)){
//                return false;
//            };
//        };
//        return true;
//    }

    public function vincularCarrera($carrera, $accion = true){
        if ($accion){
            $this->setCarrera($carrera);
        }else {
            $this->setCarrera(null);
        };
    }
    
    public function __toString() {
        return $this->nombre;
    }
    public function __construct() {
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
     * @return TituloCarrera
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
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return TituloCarrera
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
     * @return TituloCarrera
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
     * @return TituloCarrera
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
     * @return TituloCarrera
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
}
