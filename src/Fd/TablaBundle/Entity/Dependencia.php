<?php


namespace Fd\TablaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Table(name="dependencia")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\DependenciaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Dependencia{
    
    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $codigo;
    /**
     * @ORM\Column(length=150, nullable=false)
     */
    private $nombre;
    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Nivel")
     */
    private $nivel;
    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Turno")
     */
    private $turno;
//    /**
//     * lado propietario
//     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="carrera")
//     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
//     */
//    private $oferta;
//
//
//    /**
//     * bidireccional lado inverso
//     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\TituloCarrera", mappedBy="carrera", cascade={"persist", "remove"} )
//     * @Assert\Valid()
//     */
//    private $titulos;
//
//
//    /**
//     * @ORM\Column(type="string", nullable=true)
//     */
//    private $duracion;
//
//    /**
//     * @ORM\Column(type="integer", nullable=true)
//     * @Assert\Length(min=4, max=4)
//     */
//    private $anio_inicio;
//
//    /**
//     * bidireccional lado inverso
//     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Orientacion", mappedBy="carrera", cascade={"persist", "remove"} )
//     * @Assert\Valid()
//     */
//    private $orientaciones;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoCarrera")
//     */
//    private $estado;
//    /**
//     * @ORM\Column(type="string", length=250, nullable=true)
//     */
//    private $comentario;

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
    public function ultimaModificacion() {
        $this->setActualizado(new \DateTime());
    }

    public function __toString() {
        return $this->nombre;
    }
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime('now');
    }
}
