<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\ExecutionContext;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;

//use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Fd\EstablecimientoBundle\Entity\Localizacion
 *
 * @ORM\Table(name="localizacion")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\LocalizacionRepository")
 * @DoctrineAssert\UniqueEntity(fields={"unidad_educativa", "establecimiento_edificio"}, message="No se pueden repetir el nivel y la sede/anexo.")
 * @Assert\Callback(methods={"esIgualEstablecimiento"})
 */
class Localizacion {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadEducativa")
     */
    private $unidad_educativa;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio", inversedBy="localizacion")
     * @Assert\NotBlank()
     */
    private $establecimiento_edificio;

    /**
     * @ORM\OneToMany(targetEntity="Fd\EdificioBundle\Entity\DomicilioLocalizacion", mappedBy="localizacion")
     * bidireccional lado inverso
     */
    private $domicilio;

    /**
     * es el metodo del callback
     * verifica que la unidad educativa y el edificio seleccionados correspondan al mismo establecimiento
     */
    public function esIgualEstablecimiento(ExecutionContext $context) {
        if ($this->getUnidadEducativa()->getEstablecimiento()->getId() != $this->getEstablecimientoEdificio()->getEstablecimientos()->getId()){
            $context->addViolationAtSubPath('unidad_educativa', 'La unidad educativa y el edificio no corresponden al mismo establecimiento', array(), null);
        };
        return;
    }

    public function __construct() {
        $this->domicilio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->getUnidadEducativa() . ' ' . $this->getDomicilioPrincipal();
    }

    /**
     * domcilio es un array así que hay que tomar el principal o el primero
     */
    public function getDomicilioPrincipal() {
        foreach ($this->getDomicilio() as $domicilio_localizacion) {
            if ($domicilio_localizacion->getPrincipal()) {
                return $domicilio_localizacion;
            }
        }
        return $this->getDomicilio()->first();
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
     * Set unidad_educativa
     *
     * @param Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadEducativa
     */
    public function setUnidadEducativa(\Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadEducativa) {
        $this->unidad_educativa = $unidadEducativa;
    }

    /**
     * Get unidad_educativa
     *
     * @return Fd\EstablecimientoBundle\Entity\UnidadEducativa 
     */
    public function getUnidadEducativa() {
        return $this->unidad_educativa;
    }

    /**
     * Set establecimiento_edificio
     *
     * @param Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimientoEdificio
     */
    public function setEstablecimientoEdificio(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimientoEdificio) {
        $this->establecimiento_edificio = $establecimientoEdificio;
    }

    /**
     * Get establecimiento_edificio
     *
     * @return Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio 
     */
    public function getEstablecimientoEdificio() {
        return $this->establecimiento_edificio;
    }

    /**
     * Add domicilio
     *
     * @param Fd\EdificioBundle\Entity\DomicilioLocalizacion $domicilio
     */
    public function addDomicilioLocalizacion(\Fd\EdificioBundle\Entity\DomicilioLocalizacion $domicilio) {
        $this->domicilio[] = $domicilio;
    }

    /**
     * Get domicilio
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDomicilio() {
        return $this->domicilio;
    }

}