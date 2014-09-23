<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Fd\EstablecimientoBundle\Entity\UnidadOferta
 * 
 * Es la relación entre unidad_educativa y oferta_educativa.
 * Es una oferta en particular asociada a una unidad educativa de un establecimiento en particular
 * Cada oferta se dicta en uno o mas establecimientos.
 * Las ofertas pueden ser de cualquier nivel.
 *
 * @ORM\Table(name="unidad_oferta")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\UnidadOfertaRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 */
class UnidadOferta {

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
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadEducativa", inversedBy="ofertas")
     * @ORM\JoinColumn(name="unidad_educativa_id", referencedColumnName="id")
     */
    private $unidades;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="unidades")
     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
     */
    private $ofertas;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Cohorte", mappedBy="unidad_oferta", cascade={"remove", "persist"})
     */
    private $cohortes;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno", mappedBy="unidad_oferta", cascade={"persist", "remove"} )
     * @Assert\Valid()
     */
    private $turnos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $actualizado;

    /**
     * esta la escribí yo, no es automática
     */
    public function setTurnos(ArrayCollection $turnos) {
        $this->turnos = $turnos;
        foreach ($turnos as $unidadoferta_turno) {
            $unidadoferta_turno->setUnidadOferta($this);
        }
    }
    /**
     * Add turnos
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno $turnos
     * @return UnidadOferta
     */
    public function addTurno(\Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno $turno)
    {
        $turno->setUnidadOferta($this);
        $this->turnos[] = $turno;

        return $this;
    }
    public function __toString() {
        return $this->getUnidades() . ' - ' . $this->getOfertas();
    }

    public function __construct() {
        $this->cohortes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->turnos = new ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
    }

    public function combo() {
        return $this->getOfertas()->getCarrera()->getNombre();
    }

    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion() {
        $this->setActualizado(new \DateTime());
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
     * Set unidades
     *
     * @param Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidades
     */
    public function setUnidades(\Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidades) {
        $this->unidades = $unidades;
    }

    /**
     * Get unidades
     *
     * @return Fd\EstablecimientoBundle\Entity\UnidadEducativa 
     */
    public function getUnidades() {
        return $this->unidades;
    }

    /**
     * Set ofertas
     *
     * @param Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas
     */
    public function setOfertas(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas) {
        $this->ofertas = $ofertas;
    }

    /**
     * Get ofertas
     *
     * @return Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOfertas() {
        return $this->ofertas;
    }

    /**
     * Add cohortes
     *
     * @param Fd\OfertaEducativaBundle\Entity\Cohorte $cohortes
     */
    public function addCohorte(\Fd\OfertaEducativaBundle\Entity\Cohorte $cohortes) {
        $this->cohortes[] = $cohortes;
    }

    /**
     * Get cohortes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCohortes() {
        return $this->cohortes;
    }

    /**
     * Remove cohortes
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Cohorte $cohortes
     */
    public function removeCohorte(\Fd\OfertaEducativaBundle\Entity\Cohorte $cohortes) {
        $this->cohortes->removeElement($cohortes);
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return UnidadOferta
     */
    public function setCreado($creado) {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime 
     */
    public function getCreado() {
        return $this->creado;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return UnidadOferta
     */
    public function setActualizado($actualizado) {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime 
     */
    public function getActualizado() {
        return $this->actualizado;
    }



    /**
     * Remove turnos
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno $turnos
     */
    public function removeTurno(\Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno $turnos)
    {
        $this->turnos->removeElement($turnos);
    }

    /**
     * Get turnos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTurnos()
    {
        return $this->turnos;
    }
}
