<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Fd\OfertaEducativaBundle\Entity\Carrera;

/**
 * @ORM\Table(name="orientacion")
 * @ORM\Entity
 */
class Orientacion {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Carrera", inversedBy="orientaciones", cascade={"persist", "remove"})
     */
    private $carrera;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duracion;

    public function __toString() {
        return $this->nombre;
    }
    /**
     * @Assert\True(message="Si tiene cargado un estado, debe cargar la fecha correspondiente")
     */
    public function isCorrecto() {
        if (empty($this->carrera))
            return false;

        if (empty($this->nombre) and empty($this->titulo)) {
            return false;
        } else {
            return true;
        };
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
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
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
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
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
     */
    public function setDuracion($duracion) {
        $this->duracion = $duracion;
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
     * Set carrera
     *
     * @param Fd\OfertaEducativaBundle\Entity\Carrera $carrera
     */
    public function setCarrera(\Fd\OfertaEducativaBundle\Entity\Carrera $carrera) {
        $this->carrera = $carrera;
    }

    /**
     * Get carrera
     *
     * @return Fd\OfertaEducativaBundle\Entity\Carrera 
     */
    public function getCarrera() {
        return $this->carrera;
    }

}