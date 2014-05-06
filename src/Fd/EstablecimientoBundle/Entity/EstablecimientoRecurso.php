<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="establecimiento_recurso")
 * @ORM\Entity
 */
class EstablecimientoRecurso {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\Establecimiento", inversedBy="recursos")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $establecimiento;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Recurso", inversedBy="establecimiento")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $recurso;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Range(min=0, minMessage="El número ingresado no corresponde.")
     */
    private $cantidad;

    public function __toString() {
        return $this->getEstablecimiento()->getApodo().' '. $this->getRecurso()->getDescripcion();
    }

    public function __construct() {
        $this->recurso = new \Doctrine\Common\Collections\ArrayCollection();
        $this->establecimiento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return EstablecimientoRecurso
     */
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad() {
        return $this->cantidad;
    }

    /**
     * Set establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento
     * @return EstablecimientoRecurso
     */
    public function setEstablecimiento(\Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento = null) {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Fd\EstablecimientoBundle\Entity\Establecimiento 
     */
    public function getEstablecimiento() {
        return $this->establecimiento;
    }

    /**
     * Set recurso
     *
     * @param \Fd\TablaBundle\Entity\Recurso $recurso
     * @return EstablecimientoRecurso
     */
    public function setRecurso(\Fd\TablaBundle\Entity\Recurso $recurso = null) {
        $this->recurso = $recurso;

        return $this;
    }

    /**
     * Get recurso
     *
     * @return \Fd\TablaBundle\Entity\Recurso 
     */
    public function getRecurso() {
        return $this->recurso;
    }

}