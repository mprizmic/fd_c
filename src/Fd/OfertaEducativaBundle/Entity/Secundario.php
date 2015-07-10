<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Table(name="secundario")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\SecundarioRepository")
 */
class Secundario {

    const TIPO = "Secundario";

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="secundario")
     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
     */
    private $oferta;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duracion;

    public function getTipo() {
        return self::TIPO;
    }

    public function __toString() {
        return $this->getTipo() . $this->duracion . ' años.';
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
     * Set nombre
     *
     * @param string $nombre
     * @return Secundario
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Secundario
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     * @return Secundario
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
     * @return Secundario
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

}
