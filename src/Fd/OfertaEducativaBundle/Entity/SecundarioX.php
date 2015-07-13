<?php
/**
 * Tabla para la NES. Por ahora se asocia con un nuevo tipo de oferta SECUNDARIO.
 * BACHILLERATO se deja por si conviene luego eliminarlo.
 * Por ahora no está claro si el servicio es "bachillerato" y luego cada tipo de secundaria es como otra carrera más 
 * o si cada uno es un tipo diferente de ofert educativa.
 * Por ahora el tipo BACHILLERATO tiene su correlato de existencia a SECUNDARIO_X.
 * Pareciera ser que son 2 carreras del nivel medio que se superponen.
 * 
 * 
 */
namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="secundario_x")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\SecundarioXRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SecundarioX {

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
     * @Assert\Range(max=2500, maxMessage="La matrícula es muy grande. Revíselo.")
     * @var type 
     */
    private $matricula;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(min=4, max=4, minMessage="Número muy chico", maxMessage="Número muy grande")
     */
    private $anio_inicio;
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
        return 'SecundarioX';
    }
    
    /**
     * Constructor
     */
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
     * Set matricula
     *
     * @param integer $matricula
     * @return SecundarioX
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
     * @return SecundarioX
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
     * @return SecundarioX
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
     * @return SecundarioX
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
