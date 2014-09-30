<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;

/**
 * @ORM\Table(name="primario")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\PrimarioRepository")
 */
class Primario {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;
    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="primario")
     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
     */
    private $oferta;
    /**
     * @ORM\Column(type="string")
     */
    private $duracion;
    /**
     * @ORM\Column(type="string")
     */
    private $descripcion;


    public function __toString() {
        return $this->descripcion . ' - ' .$this->duracion;
    }

    public function __construct() {
        $this->descripcion = 'Primaria común';
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
     * Set duracion
     *
     * @param string $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
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
     * @param Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta
     */
    public function setOferta(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta)
    {
        $this->oferta = $oferta;
    }

    /**
     * Get oferta
     *
     * @return Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set oferta_primario
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaPrimario
     * @return Primario
     */
    public function setOfertaPrimario(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaPrimario = null)
    {
        $this->oferta_primario = $ofertaPrimario;
    
        return $this;
    }

    /**
     * Get oferta_primario
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOfertaPrimario()
    {
        return $this->oferta_primario;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Primario
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
