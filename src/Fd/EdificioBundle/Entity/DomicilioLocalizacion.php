<?php

namespace Fd\EdificioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Table(name="domicilio_localizacion")
 * @ORM\Entity(repositoryClass="Fd\EdificioBundle\Repository\DomicilioLocalizacionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class DomicilioLocalizacion
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
     * @ORM\ManyToOne(targetEntity="Fd\EdificioBundle\Entity\Domicilio", inversedBy="localizacion")
     * @Assert\NotBlank()
     */    
    private $domicilio;
    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\Localizacion", inversedBy="domicilio")
     * @Assert\NotBlank()
     */    
    private $localizacion;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $principal;

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
        if ($this->domicilio){
            return $this->domicilio->getCompleto();
        }else{
            return 's/d';
        }
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
     * Set domicilio
     *
     * @param Fd\EdificioBundle\Entity\Domicilio $domicilio
     */
    public function setDomicilio(\Fd\EdificioBundle\Entity\Domicilio $domicilio)
    {
        $this->domicilio = $domicilio;
    }

    /**
     * Get domicilio
     *
     * @return Fd\EdificioBundle\Entity\Domicilio 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set localizacion
     *
     * @param Fd\EstablecimientoBundle\Entity\Localizacion $localizacion
     */
    public function setLocalizacion(\Fd\EstablecimientoBundle\Entity\Localizacion $localizacion)
    {
        $this->localizacion = $localizacion;
    }

    /**
     * Get localizacion
     *
     * @return Fd\EstablecimientoBundle\Entity\Localizacion 
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return DomicilioLocalizacion
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
     * @return DomicilioLocalizacion
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