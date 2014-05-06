<?php

namespace Fd\TablaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fd\TablaBundle\Entity\Glosario
 *
 * @ORM\Table(name="glosario")
 * @ORM\Entity
 */
class Glosario
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
     * @ORM\Column(nullable=true)
     */
    private $termino;
    /**
     * @ORM\Column(nullable=true)
     */
    private $descripcion;

    public function __toString() {
        return $this->getTermino();
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
     * Set termino
     *
     * @param string $termino
     */
    public function setTermino($termino)
    {
        $this->termino = $termino;
    }

    /**
     * Get termino
     *
     * @return string 
     */
    public function getTermino()
    {
        return $this->termino;
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
}