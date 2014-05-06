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
 * @ORM\Table(name="titulo_estado_validez")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\TituloEstadoValidezRepository")
 * @ORM\HasLifecycleCallbacks
 */
class TituloEstadoValidez {

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
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Titulo", inversedBy="estados_validez")
     * @ORM\JoinColumn(name="titulo_id", referencedColumnName="id")
     */
    private $el_titulo;

    /**
     * Es el dato copiado de la tabla Titulo. Corresponde al estado anterior al actual
     * 
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoValidez")
     */
    private $estado_validez;

    /**
     * Es el dato copiado de la tabla Titulo
     * 
     * @ORM\Column(type="date", nullable=true)
     * 
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

    public function __toString() {
        return $this->estado_validez . ' ' . $this->fecha_estado_validez;
    }
    public function __construct(Titulo $titulo = null) {
        if (!is_null($titulo)){
            $this->el_titulo = $titulo;
            $this->estado_validez = $titulo->getEstadoValidez();
            $this->fecha_estado_validez = $titulo->getFechaEstadoValidez();
            $this->validez_desde = $titulo->getValidezDesde();
            $this->validez_hasta = $titulo->getValidezHasta();            
        };
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
     * Set fecha_estado_validez
     *
     * @param \DateTime $fechaEstadoValidez
     * @return TituloEstadoValidez
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TituloEstadoValidez
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

    /**
     * Set el_titulo
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Titulo $elTitulo
     * @return TituloEstadoValidez
     */
    public function setElTitulo(\Fd\OfertaEducativaBundle\Entity\Titulo $elTitulo = null)
    {
        $this->el_titulo = $elTitulo;
    
        return $this;
    }

    /**
     * Get el_titulo
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Titulo 
     */
    public function getElTitulo()
    {
        return $this->el_titulo;
    }

    /**
     * Set estado_validez
     *
     * @param \Fd\TablaBundle\Entity\EstadoValidez $estadoValidez
     * @return TituloEstadoValidez
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
     * Set validez_desde
     *
     * @param \DateTime $validezDesde
     * @return TituloEstadoValidez
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
     * @return TituloEstadoValidez
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
     * @return TituloEstadoValidez
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
     * @return TituloEstadoValidez
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
}