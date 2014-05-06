<?php
namespace Fd\TablaBundle\Entity;

use Fd\TablaBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="estado_validez")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\EstadoValidezRepository")
 */
class EstadoValidez
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $codigo;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $descripcion;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $orden;

    public function __toString(){
        return $this->getDescripcion();
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
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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
     * Set descripcion
     *
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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
}