<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="primario_x")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\PrimarioXRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PrimarioX {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario no bidireccional
     * @ORM\OneToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta")
     * @ORM\JoinColumn(name="unidad_oferta_id", referencedColumnName="id")
     */
    private $unidad_oferta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(max=1500, maxMessage="La matrícula es muy grande. Revíselo.")
     * @var type 
     */
    private $matricula;
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
        return 'PrimarioX';
    }
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->salas = new ArrayCollection();
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
     * Set matricula
     *
     * @param integer $matricula
     * @return PrimarioX
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return integer 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return PrimarioX
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
     * @return PrimarioX
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
     * Set unidad_oferta
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $unidadOferta
     * @return PrimarioX
     */
    public function setUnidadOferta(\Fd\EstablecimientoBundle\Entity\UnidadOferta $unidadOferta = null)
    {
        $this->unidad_oferta = $unidadOferta;
    
        return $this;
    }

    /**
     * Get unidad_oferta
     *
     * @return \Fd\EstablecimientoBundle\Entity\UnidadOferta 
     */
    public function getUnidadOferta()
    {
        return $this->unidad_oferta;
    }
}