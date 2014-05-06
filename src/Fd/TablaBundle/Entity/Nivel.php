<?php

namespace Fd\TablaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fd\TablaBundle\Entity\Nivel
 *
 * @ORM\Table(name="nivel")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\NivelRepository")
 */
class Nivel
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @var string $abreviatura
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=true)
     */
    private $abreviatura;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orden;

    public function __toString() {
        return $this->getAbreviatura();
    }
    /**
     * @ORM\Column(type="string", nullable=false)
     * 
     */
    private $crearUOClass;

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
     * Set abreviatura
     *
     * @param string $abreviatura
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
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
     * Set crearUOClass
     *
     * @param string $crearUOClass
     * @return Nivel
     */
    public function setCrearUOClass($crearUOClass)
    {
        $this->crearUOClass = $crearUOClass;
    
        return $this;
    }

    /**
     * Get crearUOClass
     *
     * @return string 
     */
    public function getCrearUOClass()
    {
        return $this->crearUOClass;
    }
}