<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\TablaBundle\Entity\Turno;

/**
 * Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno
 *
 * @ORM\Table(name="unidadoferta_turno")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\UnidadOfertaTurnoRepository")
 */
class UnidadOfertaTurno {

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
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", inversedBy="turnos", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unidad_oferta_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $unidad_oferta;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Turno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="turno_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $turno;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @return type
     * @Assert\Range(min=0, max=9999, minMessage="Número muy chico", maxMessage="Número muy grande")
     */
    private $cupo;
    
    public function __toString() {
        return $this->getUnidadOferta() . '/' . $this->getTurno()->getDescripcion();
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
     */
    public function setUnidadOferta(\Fd\EstablecimientoBundle\Entity\UnidadOferta $unidadOferta = null)
    {
        $this->unidad_oferta = $unidadOferta;
    
        return $this;
    }

    /**
     */
    public function getUnidadOferta()
    {
        return $this->unidad_oferta;
    }

    /**
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

    /**
     * Set cupo
     *
     * @param integer $cupo
     * @return UnidadOfertaTurno
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;

        return $this;
    }

    /**
     * Get cupo
     *
     * @return integer 
     */
    public function getCupo()
    {
        return $this->cupo;
    }
}
