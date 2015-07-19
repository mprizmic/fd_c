<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="media_orientaciones")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\MediaOrientacionesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MediaOrientaciones
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=4, nullable=false)
     */
    private $codigo;
    /**
     * @var string $nombre
     *
     * @ORM\Column(length=250, nullable=true)
     */
    private $nombre;
    
    /**
     * @ORM\Column(name="orden", type="integer", length=2, nullable=true)
     */
    private $orden;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion", mappedBy="orientacion", cascade={"persist", "remove"} )
     */
    private $secundarioxs;
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
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
        $this->secundarioxs = new ArrayCollection();
    }
    public function __toString() {
        return $this->getNombre();
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
     * @return MediaOrientaciones
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
     * @return MediaOrientaciones
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
     * Set orden
     *
     * @param integer $orden
     * @return MediaOrientaciones
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return MediaOrientaciones
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
     * @return MediaOrientaciones
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
     * Add secundarioxs
     *
     * @param \Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $secundarioxs
     * @return MediaOrientaciones
     */
    public function addSecundariox(\Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $secundarioxs)
    {
        $this->secundarioxs[] = $secundarioxs;

        return $this;
    }

    /**
     * Remove secundarioxs
     *
     * @param \Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $secundarioxs
     */
    public function removeSecundariox(\Fd\OfertaEducativaBundle\Entity\SecundarioXOrientacion $secundarioxs)
    {
        $this->secundarioxs->removeElement($secundarioxs);
    }

    /**
     * Get secundarioxs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSecundarioxs()
    {
        return $this->secundarioxs;
    }
}
