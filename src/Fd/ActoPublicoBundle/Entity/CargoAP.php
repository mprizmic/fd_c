<?php

namespace Fd\ActoPublicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargo
 *
 * @ORM\Table(name="cargo_ap")
 * @ORM\Entity
 */
class CargoAP
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150, nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad_horas", type="time", nullable=true)
     * en su defecto usar decimal con precision=2
     */
    private $cantidadHoras;




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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CargoAP
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
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
     * Set cantidadHoras
     *
     * @param \DateTime $cantidadHoras
     * @return CargoAP
     */
    public function setCantidadHoras($cantidadHoras)
    {
        $this->cantidadHoras = $cantidadHoras;

        return $this;
    }

    /**
     * Get cantidadHoras
     *
     * @return \DateTime 
     */
    public function getCantidadHoras()
    {
        return $this->cantidadHoras;
    }
}
