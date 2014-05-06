<?php

namespace Fd\TablaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fd\TablaBundle\Entity\Barrio
 *
 * @ORM\Table(name="barrio")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\BarrioRepository")
 */
class Barrio
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
     * @ORM\Column(type="datetime", nullable=true)
     * @var type 
     */
    private $created;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var type 
     */
    private $updated;
    /**
     * @var string $abreviatura
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=true)
     */
    private $abreviatura;

    public function setUpdate(){
        $this->setUpdated(new \DateTime("now"));
    }
    public function __toString() {
        return $this->getNombre();
    }
    public function __construct() {
        $this->created = new \DateTime("now");
        $this->updated = new \DateTime("now");
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
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
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
}