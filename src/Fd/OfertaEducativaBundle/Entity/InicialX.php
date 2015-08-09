<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="inicial_x")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\InicialXRepository")
 * @ORM\HasLifecycleCallbacks
 */
class InicialX {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado inverso bidireccional
     * @ORM\OneToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", mappedBy="salas_inicial", cascade={"persist", "remove"}))
     */
    private $unidad_oferta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(max=500, maxMessage="La matrícula es muy grande. Revíselo.")
     * @var type 
     */
    private $matricula;

    /**
     * lado inverso bidireccional
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Sala", mappedBy="inicial_x", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $salas;
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
        return 'InicialX';
    }
    /**
     * Add salas
     * Tocado por mi luego de la generaciòn automática
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Sala $salas
     * @return InicialX
     */
    public function addSala(\Fd\OfertaEducativaBundle\Entity\Sala $salas)
    {
        $salas->setInicialX($this);
        $this->salas[] = $salas;
    
        return $this;
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
     * @return InicialX
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
     * Set unidad_oferta
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $unidadOferta
     * @return InicialX
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


    /**
     * Remove salas
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Sala $salas
     */
    public function removeSala(\Fd\OfertaEducativaBundle\Entity\Sala $salas)
    {
        $this->salas->removeElement($salas);
    }

    /**
     * Get salas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalas()
    {
        return $this->salas;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return InicialX
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
     * @return InicialX
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
