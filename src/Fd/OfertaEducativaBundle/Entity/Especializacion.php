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
 * @ORM\Table(name="especializacion")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\EspecializacionRepository")
 */
class Especializacion {

    const TIPO = "Especializacion";

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="especializacion")
     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
     */
    private $oferta;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $carrera;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\TipoEspecializacion")
     */
    private $tipo_especializacion;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duracion;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoCarrera")
     */
    private $estado;

    /**
     * Esta es la última  cohorte para la cual está dada la validez de la especializacion. Se carga sòlo el año
     * 
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(min=2000, max=2500, minMessage="El dato es muy antiguo", maxMessage="El dato es muy futuro")
     * @return type 
     */
    private $ultima_cohorte_valida;

    public function __toString() {
        return $this->getNombre();
    }

    public function getTipo() {
        return self::TIPO;
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
     * Set carrera
     *
     * @param string $carrera
     * @return Especializacion
     */
    public function setCarrera($carrera) {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get carrera
     *
     * @return string 
     */
    public function getCarrera() {
        return $this->carrera;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Especializacion
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
     * Set nombre
     *
     * @param string $nombre
     * @return Especializacion
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
     * Set duracion
     *
     * @param string $duracion
     * @return Especializacion
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
     * @return Especializacion
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
     * Set tipo_especializacion
     *
     * @param \Fd\TablaBundle\Entity\TipoEspecializacion $tipoEspecializacion
     * @return Especializacion
     */
    public function setTipoEspecializacion(\Fd\TablaBundle\Entity\TipoEspecializacion $tipoEspecializacion = null) {
        $this->tipo_especializacion = $tipoEspecializacion;

        return $this;
    }

    /**
     * Get tipo_especializacion
     *
     * @return \Fd\TablaBundle\Entity\TipoEspecializacion 
     */
    public function getTipoEspecializacion() {
        return $this->tipo_especializacion;
    }

    /**
     * Set estado
     *
     * @param \Fd\TablaBundle\Entity\EstadoCarrera $estado
     * @return Especializacion
     */
    public function setEstado(\Fd\TablaBundle\Entity\EstadoCarrera $estado = null) {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Fd\TablaBundle\Entity\EstadoCarrera 
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set oferta_especializacion
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaEspecializacion
     * @return Especializacion
     */
    public function setOfertaEspecializacion(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaEspecializacion = null) {
        $this->oferta_especializacion = $ofertaEspecializacion;

        return $this;
    }

    /**
     * Get oferta_especializacion
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOfertaEspecializacion() {
        return $this->oferta_especializacion;
    }

    /**
     * Set ultima_cohorte_valida
     *
     * @param integer $ultimaCohorteValida
     * @return Especializacion
     */
    public function setUltimaCohorteValida($ultimaCohorteValida) {
        $this->ultima_cohorte_valida = $ultimaCohorteValida;

        return $this;
    }

    /**
     * Get ultima_cohorte_valida
     *
     * @return integer 
     */
    public function getUltimaCohorteValida() {
        return $this->ultima_cohorte_valida;
    }

}
