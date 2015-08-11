<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\OfertaEducativaBundle\Entity\SecundarioX;
use Fd\OfertaEducativaBundle\Entity\MediaOrientaciones;

/**
 *
 * @ORM\Table(name="secundariox_orientacion")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\SecundarioXOrientacionRepository")
 */
class SecundarioXOrientacion {

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
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\SecundarioX", inversedBy="orientaciones", cascade={"persist","remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="secundariox_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $secundariox;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\MediaOrientaciones", inversedBy="secundarioxs", cascade={"persist","remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orientacion_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $orientacion;

    public function __toString() {
        return $this->getSecundario() . '/' . $this->getOrientacion();
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
     * Set secundariox
     *
     * @param \Fd\OfertaEducativaBundle\Entity\SecundarioX $secundariox
     * @return SecundarioXOrientacion
     */
    public function setSecundariox(\Fd\OfertaEducativaBundle\Entity\SecundarioX $secundariox = null)
    {
        $this->secundariox = $secundariox;

        return $this;
    }

    /**
     * Get secundariox
     *
     * @return \Fd\OfertaEducativaBundle\Entity\SecundarioX 
     */
    public function getSecundariox()
    {
        return $this->secundariox;
    }

    /**
     * Set orientacion
     *
     * @param \Fd\OfertaEducativaBundle\Entity\MediaOrientaciones $orientacion
     * @return SecundarioXOrientacion
     */
    public function setOrientacion(\Fd\OfertaEducativaBundle\Entity\MediaOrientaciones $orientacion = null)
    {
        $this->orientacion = $orientacion;

        return $this;
    }

    /**
     * Get orientacion
     *
     * @return \Fd\OfertaEducativaBundle\Entity\MediaOrientaciones 
     */
    public function getOrientacion()
    {
        return $this->orientacion;
    }
}
