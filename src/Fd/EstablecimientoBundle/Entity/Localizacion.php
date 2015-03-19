<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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
 * @ORM\HasLifecycleCallbacks
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
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadEducativa", inversedBy="localizaciones")
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
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", mappedBy="localizacion")
     */
    private $ofertas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantidad_docentes;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $actualizado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;

    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion() {
        $this->setActualizado(new \DateTime());
    }

    /**
     * es el metodo del callback
     * verifica que la unidad educativa y el edificio seleccionados correspondan al mismo establecimiento
     */
    public function esIgualEstablecimiento(ExecutionContext $context) {
        if ($this->getUnidadEducativa()->getEstablecimiento()->getId() != $this->getEstablecimientoEdificio()->getEstablecimientos()->getId()) {
            $context->addViolationAtSubPath('unidad_educativa', 'La unidad educativa y el edificio no corresponden al mismo establecimiento', array(), null);
        };
        return;
    }

    public function __construct() {
        $this->domicilio = new ArrayCollection();
        $this->ofertas = new ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cantidad_docentes
     *
     * @param integer $cantidadDocentes
     * @return Localizacion
     */
    public function setCantidadDocentes($cantidadDocentes)
    {
        $this->cantidad_docentes = $cantidadDocentes;

        return $this;
    }

    /**
     * Get cantidad_docentes
     *
     * @return integer 
     */
    public function getCantidadDocentes()
    {
        return $this->cantidad_docentes;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Localizacion
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime 
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Localizacion
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime 
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Set unidad_educativa
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadEducativa
     * @return Localizacion
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
     * Set establecimiento_edificio
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimientoEdificio
     * @return Localizacion
     */
    public function setEstablecimientoEdificio(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimientoEdificio = null)
    {
        $this->establecimiento_edificio = $establecimientoEdificio;

        return $this;
    }

    /**
     * Get establecimiento_edificio
     *
     * @return \Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio 
     */
    public function getEstablecimientoEdificio()
    {
        return $this->establecimiento_edificio;
    }

    /**
     * Add domicilio
     *
     * @param \Fd\EdificioBundle\Entity\DomicilioLocalizacion $domicilio
     * @return Localizacion
     */
    public function addDomicilio(\Fd\EdificioBundle\Entity\DomicilioLocalizacion $domicilio)
    {
        $this->domicilio[] = $domicilio;

        return $this;
    }

    /**
     * Remove domicilio
     *
     * @param \Fd\EdificioBundle\Entity\DomicilioLocalizacion $domicilio
     */
    public function removeDomicilio(\Fd\EdificioBundle\Entity\DomicilioLocalizacion $domicilio)
    {
        $this->domicilio->removeElement($domicilio);
    }

    /**
     * Get domicilio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Add ofertas
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $ofertas
     * @return Localizacion
     */
    public function addOferta(\Fd\EstablecimientoBundle\Entity\UnidadOferta $ofertas)
    {
        $this->ofertas[] = $ofertas;

        return $this;
    }

    /**
     * Remove ofertas
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $ofertas
     */
    public function removeOferta(\Fd\EstablecimientoBundle\Entity\UnidadOferta $ofertas)
    {
        $this->ofertas->removeElement($ofertas);
    }

    /**
     * Get ofertas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfertas()
    {
        return $this->ofertas;
    }
}
