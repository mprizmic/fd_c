<?php

namespace Fd\EdificioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

/**
 * Contiene los establecimientos que usan nuestros mismo edificios
 * 
 * @ORM\Table(name="vecino")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Vecino {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $nombre;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EdificioBundle\Entity\Edificio", inversedBy="vecinos"))
     * @Assert\NotBlank(message="El edificio no puede quedar en blanco")
     */
    private $edificio;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $actualizado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;    
    
    public function __toString() {
        return $this->getNombre();
    }
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();   
    }
    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion()
    {
        $this->setActualizado(new \DateTime());
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
     * @return Vecino
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
     * @return Vecino
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
     * @return Vecino
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
     * Set edificio
     *
     * @param \Fd\EdificioBundle\Entity\Edificio $edificio
     * @return Vecino
     */
    public function setEdificio(\Fd\EdificioBundle\Entity\Edificio $edificio = null)
    {
        $this->edificio = $edificio;
    
        return $this;
    }

    /**
     * Get edificio
     *
     * @return \Fd\EdificioBundle\Entity\Edificio 
     */
    public function getEdificio()
    {
        return $this->edificio;
    }
}