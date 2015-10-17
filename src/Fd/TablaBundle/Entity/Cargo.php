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
 * @ORM\Table(name="cargo")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\CargoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Cargo{
    
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
     * Set codigo
     *
     * @param string $codigo
     * @return Cargo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Cargo
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
     * @return Cargo
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
     * @return Cargo
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
     * Set nivel
     *
     * @param \Fd\TablaBundle\Entity\Nivel $nivel
     * @return Cargo
     */
    public function setNivel(\Fd\TablaBundle\Entity\Nivel $nivel = null)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return \Fd\TablaBundle\Entity\Nivel 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set turno
     *
     * @param \Fd\TablaBundle\Entity\Turno $turno
     * @return Cargo
     */
    public function setTurno(\Fd\TablaBundle\Entity\Turno $turno = null)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return \Fd\TablaBundle\Entity\Turno 
     */
    public function getTurno()
    {
        return $this->turno;
    }
}
