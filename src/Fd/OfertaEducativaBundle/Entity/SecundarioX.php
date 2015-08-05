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
     * @ORM\OneToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", mappedBy="", cascade={"remove"}))
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
}
