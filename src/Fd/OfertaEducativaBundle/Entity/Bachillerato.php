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
 * @ORM\Table(name="bachillerato")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\BachilleratoRepository")
 */
class Bachillerato  {

    const TIPO="Bachilelrato";
    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;
    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="bachillerato")
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
    private $ciclo_basico;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duracion;

    public function getTipo(){
        return self::TIPO;
    }

    public function __toString() {
        return $this->getTipo() .$this->duracion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set ciclo_basico
     *
     * @param string $cicloBasico
     */
    public function setCicloBasico($cicloBasico)
    {
        $this->ciclo_basico = $cicloBasico;
    }

    /**
     * Get ciclo_basico
     *
     * @return string 
     */
    public function getCicloBasico()
    {
        return $this->ciclo_basico;
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set oferta_bachillerato
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaBachillerato
     * @return Bachillerato
     */
    public function setOfertaBachillerato(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertaBachillerato = null)
    {
        $this->oferta_bachillerato = $ofertaBachillerato;
    
        return $this;
    }

    /**
     * Get oferta_bachillerato
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOfertaBachillerato()
    {
        return $this->oferta_bachillerato;
    }
}