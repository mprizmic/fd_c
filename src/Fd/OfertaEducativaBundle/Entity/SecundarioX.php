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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
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
     * lado inverso bidireccional
     * @ORM\OneToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", mappedBy="secundario", cascade={"persist", "remove"}))
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
     * bidireccional lado propietario
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion", mappedBy="secundariox", cascade={"persist", "remove"} )
     */    
    private $orientaciones;
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
        return 'NES (' . $this->getId() . ')';
    }
    /**
     * esta la escribí yo, no es automática
     */
    public function setOrientaciones(ArrayCollection $orientaciones) {
        $this->orientaciones = $orientaciones;
        foreach ($this->orientaciones as $secundariox_orientacion) {
            $secundariox_orientacion->setSecundariox($this);
        }
    }    

    /**
     * Add orientaciones
     *
     * @param \Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $orientaciones
     * @return SecundarioX
     */
    public function addOrientacione(\Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $orientacion)
    {
        $orientacion->setSecundariox($this);
        $this->orientaciones[] = $orientacion;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();   
        $this->orientaciones = new ArrayCollection();
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
     * Set anio_inicio
     *
     * @param integer $anioInicio
     * @return SecundarioX
     */
    public function setAnioInicio($anioInicio)
    {
        $this->anio_inicio = $anioInicio;

        return $this;
    }

    /**
     * Get anio_inicio
     *
     * @return integer 
     */
    public function getAnioInicio()
    {
        return $this->anio_inicio;
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

    /**
     * Remove orientaciones
     *
     * @param \Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $orientaciones
     */
    public function removeOrientacione(\Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $orientaciones)
    {
        $this->orientaciones->removeElement($orientaciones);
    }

    /**
     * Get orientaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrientaciones()
    {
        return $this->orientaciones;
    }
}
