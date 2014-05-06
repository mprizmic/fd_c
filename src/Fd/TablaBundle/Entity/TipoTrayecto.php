<?php
namespace Fd\TablaBundle\Entity;

use Fd\TablaBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Table(name="tipo_trayecto")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\TipoTrayectoRepository")
 * @DoctrineAssert\UniqueEntity(fields="codigo", message="El código de tipo de trayecto ya está siendo usado")
 */
class TipoTrayecto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=4, nullable=false)
     * @Assert\NotBlank(message="El código no puede quedar en blanco")
     */
    protected $codigo;
    /**
     * @ORM\Column(type="string", length=150, nullable=false)
     * @Assert\NotBlank(message="La descripción no puede quedar en blanco")
     */
    protected $descripcion;
    /**
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    protected $orden;

    public function __toString() {
        return $this->getCodigo();
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