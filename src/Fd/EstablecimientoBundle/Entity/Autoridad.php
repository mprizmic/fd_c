<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fd\TablaBundle\Entity\CargoAutoridad;
use Fd\EstablecimientoBundle\Validator\Constraints as ApellidoAssert;
/**
 * @ORM\Table(name="autoridad")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Autoridad
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
     * @var string $nombre
     *
     * @ORM\Column(length=50, nullable=true)
     */
    private $nombre;
    /**
     * @var string $nombre
     *
     * @ORM\Column(length=50, nullable=false)
     * @ApellidoAssert\Apellido
     */
    private $apellido;
    /**
     * @ORM\Column(length=50, nullable=true)
     */
    private $te_particular;
    /**
     * @ORM\Column(length=50, nullable=true)
     */
    private $celular;
    /**
     * @ORM\Column(length=50, nullable=true)
     * @Assert\Email(message="El email no es válido")
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\CargoAutoridad")
     */
    private $cargo_autoridad;
    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Establecimiento", inversedBy="autoridades_rectorado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })    
     * 
     */
    private $establecimiento;
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
    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function pasarAMayuscula()
    {
        $this->setApellido(strtoupper($this->getApellido()));
    }
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
    }
    public function __toString() {
        return $this->getApellido() . ', ' . $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set cargo_autoridad
     *
     * @param Fd\TablaBundle\Entity\CargoAutoridad $cargoAutoridad
     */
    public function setCargoAutoridad(\Fd\TablaBundle\Entity\CargoAutoridad $cargoAutoridad)
    {
        $this->cargo_autoridad = $cargoAutoridad;
    }

    /**
     * Get cargo_autoridad
     *
     * @return Fd\TablaBundle\Entity\CargoAutoridad 
     */
    public function getCargoAutoridad()
    {
        return $this->cargo_autoridad;
    }

    /**
     * Set establecimiento
     *
     * @param Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento
     */
    public function setEstablecimiento(\Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento)
    {
        $this->establecimiento = $establecimiento;
    }

    /**
     * Get establecimiento
     *
     * @return Fd\EstablecimientoBundle\Entity\Establecimiento 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Autoridad
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
     * @return Autoridad
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
     * Set celular
     *
     * @param string $celular
     * @return Autoridad
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Autoridad
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set te_particular
     *
     * @param string $teParticular
     * @return Autoridad
     */
    public function setTeParticular($teParticular)
    {
        $this->te_particular = $teParticular;
    
        return $this;
    }

    /**
     * Get te_particular
     *
     * @return string 
     */
    public function getTeParticular()
    {
        return $this->te_particular;
    }
}