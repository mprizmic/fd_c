<?php

namespace Fd\EdificioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Fd\EdificioBundle\Entity\Domicilio;

/**
 * @ORM\Table(name="edificio")
 * @ORM\Entity(repositoryClass="Fd\EdificioBundle\Repository\EdificioRepository")
 */
class Edificio {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $cui
     *
     * @ORM\Column(name="cui", type="integer", nullable=true, unique=true)
     * @Assert\Range(min="0", max="999999", minMessage="El nro de CUI es inválido", maxMessage="CUI fuera de rango. Puede tener hasta 6 dígitos")
     */
    private $cui;
    /**
     * @ORM\Column(type="string", nullable=true, unique=true, length=50)
     * 
     */
    private $referencia;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio", mappedBy="edificios")
     */
    private $establecimiento;

    /**
     * @var integer $superficie
     *
     * @ORM\Column(name="superficie", type="integer", nullable=true)
     */
    private $superficie;

    /**
     * @var Comuna
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Comuna")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comuna_id", referencedColumnName="id")
     * })
     */
    private $comuna;

    /**
     * @var Cgp
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Cgp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cgp_id", referencedColumnName="id")
     * })
     */
    private $cgp;

    /**
     * @var Barrio
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Barrio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="barrio_id", referencedColumnName="id")
     * })
     */
    private $barrio;

    /**
     * @var DistritoEscolar
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\DistritoEscolar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrito_escolar_id", referencedColumnName="id")
     * })
     */
    private $distritoEscolar;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EdificioBundle\Entity\Domicilio", mappedBy="edificio")
     */
    private $domicilios;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EdificioBundle\Entity\Vecino", mappedBy="edificio")
     */
    private $vecinos;
    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EdificioBundle\Entity\Inspector", inversedBy="edificios")
     */
    private $inspector;
    /**
     * @var TipoDominio
     *
     * @ORM\ManyToOne(targetEntity="TipoDominio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_dominio_id", referencedColumnName="id")
     * })
      private $tipoDominio;
     */
    /**
     * @var TipoEdificio
     *
     * @ORM\ManyToOne(targetEntity="TipoEdificio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_edificio_id", referencedColumnName="id")
     * })
      private $tipoEdificio;
     */
    /**
     * @var EstadoEdificio
     *
     * @ORM\ManyToOne(targetEntity="EstadoEdificio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_edificio_id", referencedColumnName="id")
     * })
      private $estadoEdificio;
     */
    /**
     * @var Hospital
     *
     * @ORM\ManyToOne(targetEntity="Hospital")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hospital_id", referencedColumnName="id")
     * })
      private $hospital;
     */
    /**
     * @var SituacionContractual
     *
     * @ORM\ManyToOne(targetEntity="SituacionContractual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="situacion_contractual_id", referencedColumnName="id")
     * })
      private $situacionContractual;
     */

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var type 
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     * @var type 
     */
    private $createdAt;

    public function getDomicilioPrincipal() {
        $el_principal = null;
        foreach ($this->getDomicilios() as $domicilio) {
            if ($domicilio->getPrincipal()) {
                $el_principal = $domicilio;
                break;
            }
        };
        return $el_principal;
    }
    /**
     * elimina un domicilio del edificio
     */
    public function removeDomicilios(Domicilio $domicilio) {
        $this->domicilios->removeElement($domicilio);
    }    
    
    public function __toString() {
        $salida = $this->referencia;
        if (!$this->getDomicilioPrincipal()) {
            return $salida;
        } else {
            return $salida . ' - ' . $this->getDomicilioPrincipal()->__toString();
        }
    }
    public function __construct() {
        $this->establecimiento = new \Doctrine\Common\Collections\ArrayCollection();
        $this->domicilios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vecinos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
//        $this->setUpdate(); no ANDA
    }
    /**
     * se actualiza por un comportamiento de doctrine hecho con un listener y un servicio
     */
    public function setUpdate(){
        $this->setUpdatedAt(new \DateTime());
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
     * Set cui
     *
     * @param integer $cui
     * @return Edificio
     */
    public function setCui($cui)
    {
        $this->cui = $cui;

        return $this;
    }

    /**
     * Get cui
     *
     * @return integer 
     */
    public function getCui()
    {
        return $this->cui;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Edificio
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string 
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set superficie
     *
     * @param integer $superficie
     * @return Edificio
     */
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;

        return $this;
    }

    /**
     * Get superficie
     *
     * @return integer 
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Edificio
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Edificio
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimiento
     * @return Edificio
     */
    public function addEstablecimiento(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimiento)
    {
        $this->establecimiento[] = $establecimiento;

        return $this;
    }

    /**
     * Remove establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimiento
     */
    public function removeEstablecimiento(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $establecimiento)
    {
        $this->establecimiento->removeElement($establecimiento);
    }

    /**
     * Get establecimiento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Set comuna
     *
     * @param \Fd\TablaBundle\Entity\Comuna $comuna
     * @return Edificio
     */
    public function setComuna(\Fd\TablaBundle\Entity\Comuna $comuna = null)
    {
        $this->comuna = $comuna;

        return $this;
    }

    /**
     * Get comuna
     *
     * @return \Fd\TablaBundle\Entity\Comuna 
     */
    public function getComuna()
    {
        return $this->comuna;
    }

    /**
     * Set cgp
     *
     * @param \Fd\TablaBundle\Entity\Cgp $cgp
     * @return Edificio
     */
    public function setCgp(\Fd\TablaBundle\Entity\Cgp $cgp = null)
    {
        $this->cgp = $cgp;

        return $this;
    }

    /**
     * Get cgp
     *
     * @return \Fd\TablaBundle\Entity\Cgp 
     */
    public function getCgp()
    {
        return $this->cgp;
    }

    /**
     * Set barrio
     *
     * @param \Fd\TablaBundle\Entity\Barrio $barrio
     * @return Edificio
     */
    public function setBarrio(\Fd\TablaBundle\Entity\Barrio $barrio = null)
    {
        $this->barrio = $barrio;

        return $this;
    }

    /**
     * Get barrio
     *
     * @return \Fd\TablaBundle\Entity\Barrio 
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Set distritoEscolar
     *
     * @param \Fd\TablaBundle\Entity\DistritoEscolar $distritoEscolar
     * @return Edificio
     */
    public function setDistritoEscolar(\Fd\TablaBundle\Entity\DistritoEscolar $distritoEscolar = null)
    {
        $this->distritoEscolar = $distritoEscolar;

        return $this;
    }

    /**
     * Get distritoEscolar
     *
     * @return \Fd\TablaBundle\Entity\DistritoEscolar 
     */
    public function getDistritoEscolar()
    {
        return $this->distritoEscolar;
    }

    /**
     * Add domicilios
     *
     * @param \Fd\EdificioBundle\Entity\Domicilio $domicilios
     * @return Edificio
     */
    public function addDomicilio(\Fd\EdificioBundle\Entity\Domicilio $domicilios)
    {
        $this->domicilios[] = $domicilios;

        return $this;
    }

    /**
     * Remove domicilios
     *
     * @param \Fd\EdificioBundle\Entity\Domicilio $domicilios
     */
    public function removeDomicilio(\Fd\EdificioBundle\Entity\Domicilio $domicilios)
    {
        $this->domicilios->removeElement($domicilios);
    }

    /**
     * Get domicilios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDomicilios()
    {
        return $this->domicilios;
    }

    /**
     * Add vecinos
     *
     * @param \Fd\EdificioBundle\Entity\Vecino $vecinos
     * @return Edificio
     */
    public function addVecino(\Fd\EdificioBundle\Entity\Vecino $vecinos)
    {
        $this->vecinos[] = $vecinos;

        return $this;
    }

    /**
     * Remove vecinos
     *
     * @param \Fd\EdificioBundle\Entity\Vecino $vecinos
     */
    public function removeVecino(\Fd\EdificioBundle\Entity\Vecino $vecinos)
    {
        $this->vecinos->removeElement($vecinos);
    }

    /**
     * Get vecinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVecinos()
    {
        return $this->vecinos;
    }

    /**
     * Set inspector
     *
     * @param \Fd\EdificioBundle\Entity\Inspector $inspector
     * @return Edificio
     */
    public function setInspector(\Fd\EdificioBundle\Entity\Inspector $inspector = null)
    {
        $this->inspector = $inspector;

        return $this;
    }

    /**
     * Get inspector
     *
     * @return \Fd\EdificioBundle\Entity\Inspector 
     */
    public function getInspector()
    {
        return $this->inspector;
    }
}
