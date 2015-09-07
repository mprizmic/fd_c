<?php

namespace Fd\EdificioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Table(name="domicilio")
 * @ORM\Entity(repositoryClass="Fd\EdificioBundle\Repository\DomicilioRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Domicilio
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
      * bidireccional lado propietario
      * @ORM\ManyToOne(targetEntity="Fd\EdificioBundle\Entity\Edificio", inversedBy="domicilios")
      */
     private $edificio;
    /**
     *
     * @var type string
     * 
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $calle;
    /**
     *
     * @var type string
     * 
     * @ORM\Column(type="string", length=5, nullable=false))
     */
    private $altura;
    /**
     *
     * @var type string
     * 
     * @ORM\Column(type="string", length=3, nullable=true)
     */    
    private $piso;
    /**
     *
     * @var type string
     * 
     * @ORM\Column(type="string", length=2, nullable=true)
     */    
    private $departamento;
        /**
     *
     * @var type string
     * 
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $referencia;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $principal;
    /**
     * @ORM\OneToMany(targetEntity="Fd\EdificioBundle\Entity\DomicilioLocalizacion", mappedBy="domicilio")
     * bidireccional lado inverso
     */
    private $localizacion; 
    
    /**
     * @ORM\Column(length=8, nullable=true)
     */
    private $c_postal;
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
    public function ultimaModificacion()
    {
        $this->setActualizado(new \DateTime());
    }
    public function __construct() {
        $this->principal=false;
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();        
    }
     public function __toString() {
         return $this->getCalle().' '.$this->getAltura();
     }
     public function getCompleto(){
         return $this->getCalle().' '.$this->getAltura().
                 ($this->getPiso()?' P: '.$this->getPiso():'').
                 ($this->getDepartamento()?' Depto: '.$this->getDepartamento():'').
                 ($this->getReferencia()?' Ref: '.$this->getReferencia():'');
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
     * Set calle
     *
     * @param string $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set altura
     *
     * @param string $altura
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    /**
     * Get altura
     *
     * @return string 
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set piso
     *
     * @param string $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     * Get piso
     *
     * @return string 
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
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
     * Set principal
     *
     * @param boolean $principal
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    }

    /**
     * Get principal
     *
     * @return boolean 
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set edificio
     *
     * @param Fd\EdificioBundle\Entity\Edificio $edificio
     */
    public function setEdificio(\Fd\EdificioBundle\Entity\Edificio $edificio)
    {
        $this->edificio = $edificio;
    }

    /**
     * Get edificio
     *
     * @return Fd\EdificioBundle\Entity\Edificio 
     */
    public function getEdificio()
    {
        return $this->edificio;
    }

    /**
     * Add localizacion
     *
     * @param Fd\EdificioBundle\Entity\DomicilioLocalizacion $localizacion
     */
    public function addDomicilioLocalizacion(\Fd\EdificioBundle\Entity\DomicilioLocalizacion $localizacion)
    {
        $this->localizacion[] = $localizacion;
    }

    /**
     * Get localizacion
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Set c_postal
     *
     * @param string $cPostal
     */
    public function setCPostal($cPostal)
    {
        $this->c_postal = $cPostal;
    }

    /**
     * Get c_postal
     *
     * @return string 
     */
    public function getCPostal()
    {
        return $this->c_postal;
    }

    /**
     * Add localizacion
     *
     * @param \Fd\EdificioBundle\Entity\DomicilioLocalizacion $localizacion
     * @return Domicilio
     */
    public function addLocalizacion(\Fd\EdificioBundle\Entity\DomicilioLocalizacion $localizacion)
    {
        $this->localizacion[] = $localizacion;
    
        return $this;
    }

    /**
     * Remove localizacion
     *
     * @param \Fd\EdificioBundle\Entity\DomicilioLocalizacion $localizacion
     */
    public function removeLocalizacion(\Fd\EdificioBundle\Entity\DomicilioLocalizacion $localizacion)
    {
        $this->localizacion->removeElement($localizacion);
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Domicilio
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
     * @return Domicilio
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
}