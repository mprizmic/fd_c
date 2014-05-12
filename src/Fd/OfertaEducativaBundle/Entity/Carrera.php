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
use Fd\OfertaEducativaBundle\Entity\Orientacion;
use Fd\OfertaEducativaBundle\Entity\Titulo;
use Fd\OfertaEducativaBundle\Listener\CarreraListener;

/**
 * @ORM\Table(name="carrera")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\CarreraRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Carrera {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="carrera")
     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
     */
    private $oferta;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\TipoFormacion")
     * @Assert\NotNull(message="El campo no puede quedar vacío.")
     */
    private $formacion;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Titulo", mappedBy="carrera", cascade={"persist", "remove"} )
     * @Assert\Valid()
     */
    private $titulos;

    /**
     * @ORM\Column(length=150, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duracion;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Orientacion", mappedBy="carrera", cascade={"persist", "remove"} )
     * @Assert\Valid()
     */
    private $orientaciones;

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

    public function __toString() {
        return $this->nombre;
    }
    public function getIdentificacion(){
        foreach ($this->getOferta()->getNormas() as $value) {
            $norma = $value;
            break;
        };
        return substr($this->nombre, 0, 50) .  ' - ' . $norma;
    }
    /**
     * Escrito automático y arreglado por mi
     * Add orientaciones
     *
     * @param Fd\OfertaEducativaBundle\Entity\Orientacion $orientaciones
     */
    public function addOrientaciones(Orientacion $orientacion) {
        $orientacion->setCarrera($this);
        $this->orientaciones[] = $orientacion;
    }
    /**
     * Escrito por mi
     */
    public function removeOrientaciones(Orientacion $orientacion) {
        $this->orientaciones->removeElement($orientacion);
    }
    /**
     * Escrito por mi
     */
    public function setOrientaciones($orientaciones) {
        foreach ($orientaciones as $orientacion) {
            $orientacion->setCarrera($this);
        }
        $this->orientaciones = $orientaciones;
    }
    /**
     * Add titulos
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Titulo $titulos
     * @return Carrera
     */
    public function addTitulos(Titulo $titulo)
    {
        $titulo->setCarrera($this);
        $this->titulos[] = $titulo;
    }

    /**
     * Remove titulos
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Titulo $titulos
     */
    public function removeTitulos(Titulo $titulo)
    {
        $this->titulos->removeElement($titulo);
    }
    /**
     * Escrito por mi
     */
    public function setTitulos($titulos) {
        foreach ($titulos as $titulo) {
            $titulo->setCarrera($this);
        };
        $this->titulos = $titulos;
    }

    public function __construct() {
        $this->orientaciones = new ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();        
    }

    public function etiqueta() {
        return 'Carrera';
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
     * @return Carrera
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
     * Set duracion
     *
     * @param string $duracion
     * @return Carrera
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    
        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set oferta
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta
     * @return Carrera
     */
    public function setOferta(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta = null)
    {
        $this->oferta = $oferta;
    
        return $this;
    }

    /**
     * Get oferta
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set formacion
     *
     * @param \Fd\TablaBundle\Entity\TipoFormacion $formacion
     * @return Carrera
     */
    public function setFormacion(\Fd\TablaBundle\Entity\TipoFormacion $formacion = null)
    {
        $this->formacion = $formacion;
    
        return $this;
    }

    /**
     * Get formacion
     *
     * @return \Fd\TablaBundle\Entity\TipoFormacion 
     */
    public function getFormacion()
    {
        return $this->formacion;
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

    /**
     * Set estado
     *
     * @param \Fd\TablaBundle\Entity\EstadoCarrera $estado
     * @return Carrera
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


    /**
     * Set oferta_carrera
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaCarrera
     * @return Carrera
     */
    public function setOfertaCarrera(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaCarrera = null)
    {
        $this->oferta_carrera = $ofertaCarrera;
    
        return $this;
    }

    /**
     * Get oferta_carrera
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOfertaCarrera()
    {
        return $this->oferta_carrera;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Carrera
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
     * @return Carrera
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
     * Get titulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTitulos()
    {
        return $this->titulos;
    }
}