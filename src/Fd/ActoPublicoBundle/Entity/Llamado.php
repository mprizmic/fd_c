<?php

namespace Fd\ActoPublicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fd\EstablecimientoBundle\Validator\Constraints as FdAssert;

/**
 * @ORM\Table(name="llamado")
 * @ORM\Entity
 */
class Llamado {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $cargo;

    /**
     * @ORM\Column(type="time", nullable=false)
     */
    private $horario;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\Establecimiento")
     */
    private $establecimiento;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\ActoPublicoBundle\Entity\Caracter")
     */
    private $caracter;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\ActoPublicoBundle\Entity\Licencia")
     */
    private $motivo;
//    private $horas;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min=4, max=4, minMessage="Número muy chico", maxMessage="Número muy grande")
     * @var type 
     */
    private $anio;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @var type 
     */
    private $division;
//    private $turno;
//    private $horarios;
    /**
     * @ORM\Column(type="date", nullable=false) 
     */
    private $iniciacion;
    /**
     * @ORM\Column(type="date", nullable=true) 
     */
    private $terminacion;
    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     * @FdAssert\Sinosd
     */
    private $continuidad_pedagogica;
    private $resultado;
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

    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
    }

    public function __toString() {
        
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
     * Set cargo
     *
     * @param string $cargo
     * @return Llamado
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set horario
     *
     * @param \DateTime $horario
     * @return Llamado
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;
    
        return $this;
    }

    /**
     * Get horario
     *
     * @return \DateTime 
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set anio
     *
     * @param string $anio
     * @return Llamado
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    
        return $this;
    }

    /**
     * Get anio
     *
     * @return string 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set division
     *
     * @param string $division
     * @return Llamado
     */
    public function setDivision($division)
    {
        $this->division = $division;
    
        return $this;
    }

    /**
     * Get division
     *
     * @return string 
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set iniciacion
     *
     * @param \DateTime $iniciacion
     * @return Llamado
     */
    public function setIniciacion($iniciacion)
    {
        $this->iniciacion = $iniciacion;
    
        return $this;
    }

    /**
     * Get iniciacion
     *
     * @return \DateTime 
     */
    public function getIniciacion()
    {
        return $this->iniciacion;
    }

    /**
     * Set terminacion
     *
     * @param \DateTime $terminacion
     * @return Llamado
     */
    public function setTerminacion($terminacion)
    {
        $this->terminacion = $terminacion;
    
        return $this;
    }

    /**
     * Get terminacion
     *
     * @return \DateTime 
     */
    public function getTerminacion()
    {
        return $this->terminacion;
    }

    /**
     * Set continuidad_pedagogica
     *
     * @return Llamado
     */
    public function setContinuidadPedagogica( $continuidadPedagogica)
    {
        $this->continuidad_pedagogica = $continuidadPedagogica;
    
        return $this;
    }

    /**
     * Get continuidad_pedagogica
     *
     * @return \sin_no_sd 
     */
    public function getContinuidadPedagogica()
    {
        return $this->continuidad_pedagogica;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Llamado
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
     * @return Llamado
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
     * Set establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento
     * @return Llamado
     */
    public function setEstablecimiento(\Fd\EstablecimientoBundle\Entity\Establecimiento $establecimiento = null)
    {
        $this->establecimiento = $establecimiento;
    
        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Fd\EstablecimientoBundle\Entity\Establecimiento 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Set caracter
     *
     * @param \Fd\ActoPublicoBundle\Entity\Caracter $caracter
     * @return Llamado
     */
    public function setCaracter(\Fd\ActoPublicoBundle\Entity\Caracter $caracter = null)
    {
        $this->caracter = $caracter;
    
        return $this;
    }

    /**
     * Get caracter
     *
     * @return \Fd\ActoPublicoBundle\Entity\Caracter 
     */
    public function getCaracter()
    {
        return $this->caracter;
    }

    /**
     * Set motivo
     *
     * @param \Fd\ActoPublicoBundle\Entity\Licencia $motivo
     * @return Llamado
     */
    public function setMotivo(\Fd\ActoPublicoBundle\Entity\Licencia $motivo = null)
    {
        $this->motivo = $motivo;
    
        return $this;
    }

    /**
     * Get motivo
     *
     * @return \Fd\ActoPublicoBundle\Entity\Licencia 
     */
    public function getMotivo()
    {
        return $this->motivo;
    }
}