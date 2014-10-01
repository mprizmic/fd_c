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
 * @ORM\Table(name="inicial")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\InicialRepository")
 */
class Inicial {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="inicial")
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
        return $this->descripcion;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     * @return Inicial
     */
    public function setDuracion($duracion) {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion() {
        return $this->duracion;
    }

    /**
     * Set oferta
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta
     * @return Inicial
     */
    public function setOferta(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta = null) {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOferta() {
        return $this->oferta;
    }


    /**
     * Set oferta_inicial
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaInicial
     * @return Inicial
     */
    public function setOfertaInicial(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaInicial = null)
    {
        $this->oferta_inicial = $ofertaInicial;
    
        return $this;
    }

    /**
     * Get oferta_inicial
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOfertaInicial()
    {
        return $this->oferta_inicial;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Inicial
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
