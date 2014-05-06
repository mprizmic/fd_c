<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\TablaBundle\Entity\Turno;

/**
 * Fd\EstablecimientoBundle\Entity\TurnoUnidadEducativa
 *
 * @ORM\Table(name="turno_unidad_educativa")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\TurnoUnidadEducativaRepository")
 */
class TurnoUnidadEducativa {

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
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadEducativa", inversedBy="turnos", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unidad_educativa_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $unidad_educativa;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Turno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="turno_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $turno;

    public function __toString() {
        return $this->getUnidadEducativa() . '/' . $this->getTurno()->getDescripcion();
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
     * Set unidad_educativa
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadEducativa
     * @return TurnoUnidadEducativa
     */
    public function setUnidadEducativa(\Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadEducativa = null)
    {
        $this->unidad_educativa = $unidadEducativa;
    
        return $this;
    }

    /**
     * Get unidad_educativa
     *
     * @return \Fd\EstablecimientoBundle\Entity\UnidadEducativa 
     */
    public function getUnidadEducativa()
    {
        return $this->unidad_educativa;
    }

    /**
     * Set turno
     *
     * @param \Fd\TablaBundle\Entity\Turno $turno
     * @return TurnoUnidadEducativa
     */
    public function setTurno(\Fd\TablaBundle\Entity\Turno $turno = null)
    {
        $this->turno = $turno;
    
        return $this;
    }

    /**
     * Get turno
     *
     * @return \Fd\TablaBundle\Entity\Turno 
     */
    public function getTurno()
    {
        return $this->turno;
    }
}