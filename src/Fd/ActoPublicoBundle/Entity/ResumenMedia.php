<?php

namespace Fd\ActoPublicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResumenMedia
 *
 * @ORM\Table(name="resumen_media")
 * @ORM\Entity(repositoryClass="Fd\ActoPublicoBundle\Repository\ResumenMediaRepository")
 */
class ResumenMedia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=20, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=30, nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=40, nullable=true)
     */
    private $cargo;
    /**
     * @var string
     *
     * @ORM\Column(name="slug_cargo", type="string", length=40, nullable=true)
     */
    private $slug_cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="establecimiento", type="string", length=100, nullable=true)
     */
    private $establecimiento;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $cargo_vacante;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_iniciacion", type="date", nullable=true)
     */
    private $fecha_iniciacion;

    /**
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $fecha_terminacion;

    /**
     *
     * @ORM\Column(name="cantidad_horas", type="string", nullable=true)
     */
    private $cantidad_horas;
    /**
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fila;
    /**
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cantidad_horas_string;
    /**
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horario_lunes;
    /**
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horario_martes;
    /**
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horario_miercoles;
    /**
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horario_jueves;
    /**
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horario_viernes;


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
     * Set numero
     *
     * @param string $numero
     * @return ResumenMedia
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return ResumenMedia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return ResumenMedia
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
     * Set cargo
     *
     * @param string $cargo
     * @return ResumenMedia
     */
    public function setCargoVacante($cargo_vacante)
    {
        $this->cargo_vacante = $cargo_vacante;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargoVacante()
    {
        return $this->cargo_vacante;
    }

    /**
     * Set establecimiento
     *
     * @param string $establecimiento
     * @return ResumenMedia
     */
    public function setEstablecimiento($establecimiento)
    {
        $this->establecimiento = $establecimiento;
    
        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return string 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Set fecha_iniciacion
     *
     * @param \DateTime $fechaIniciacion
     * @return ResumenMedia
     */
    public function setFechaIniciacion($fechaIniciacion)
    {
        $this->fecha_iniciacion = $fechaIniciacion;
    
        return $this;
    }

    /**
     * Get fecha_iniciacion
     *
     * @return \DateTime 
     */
    public function getFechaIniciacion()
    {
        return $this->fecha_iniciacion;
    }

    /**
     * Set fecha_terminacion
     *
     * @param \DateTime $fechaTerminacion
     * @return ResumenMedia
     */
    public function setFechaTerminacion($fechaTerminacion)
    {
        $this->fecha_terminacion = $fechaTerminacion;
    
        return $this;
    }

    /**
     * Get fecha_terminacion
     *
     * @return \DateTime 
     */
    public function getFechaTerminacion()
    {
        return $this->fecha_terminacion;
    }

    /**
     * Set slug_cargo
     *
     * @param string $slugCargo
     * @return ResumenMedia
     */
    public function setSlugCargo($slugCargo)
    {
        $this->slug_cargo = $slugCargo;
    
        return $this;
    }

    /**
     * Get slug_cargo
     *
     * @return string 
     */
    public function getSlugCargo()
    {
        return $this->slug_cargo;
    }

    /**
     * Set cantidad_horas_string
     *
     * @param string $cantidadHorasString
     * @return ResumenMedia
     */
    public function setCantidadHorasString($cantidadHorasString)
    {
        $this->cantidad_horas_string = $cantidadHorasString;
    
        return $this;
    }

    /**
     * Get cantidad_horas_string
     *
     * @return string 
     */
    public function getCantidadHorasString()
    {
        return $this->cantidad_horas_string;
    }

    /**
     * Set cantidad_horas
     *
     * @param \DateTime $cantidadHoras
     * @return ResumenMedia
     */
    public function setCantidadHoras($cantidadHoras)
    {
        $this->cantidad_horas = $cantidadHoras;
    
        return $this;
    }

    /**
     * Get cantidad_horas
     *
     * @return \DateTime 
     */
    public function getCantidadHoras()
    {
        return $this->cantidad_horas;
    }

    /**
     * Set horario_lunes
     *
     * @param string $horarioLunes
     * @return ResumenMedia
     */
    public function setHorarioLunes($horarioLunes)
    {
        $this->horario_lunes = $horarioLunes;
    
        return $this;
    }

    /**
     * Get horario_lunes
     *
     * @return string 
     */
    public function getHorarioLunes()
    {
        return $this->horario_lunes;
    }

    /**
     * Set horario_martes
     *
     * @param string $horarioMartes
     * @return ResumenMedia
     */
    public function setHorarioMartes($horarioMartes)
    {
        $this->horario_martes = $horarioMartes;
    
        return $this;
    }

    /**
     * Get horario_martes
     *
     * @return string 
     */
    public function getHorarioMartes()
    {
        return $this->horario_martes;
    }

    /**
     * Set horario_miercoles
     *
     * @param string $horarioMiercoles
     * @return ResumenMedia
     */
    public function setHorarioMiercoles($horarioMiercoles)
    {
        $this->horario_miercoles = $horarioMiercoles;
    
        return $this;
    }

    /**
     * Get horario_miercoles
     *
     * @return string 
     */
    public function getHorarioMiercoles()
    {
        return $this->horario_miercoles;
    }

    /**
     * Set horario_jueves
     *
     * @param string $horarioJueves
     * @return ResumenMedia
     */
    public function setHorarioJueves($horarioJueves)
    {
        $this->horario_jueves = $horarioJueves;
    
        return $this;
    }

    /**
     * Get horario_jueves
     *
     * @return string 
     */
    public function getHorarioJueves()
    {
        return $this->horario_jueves;
    }

    /**
     * Set horario_viernes
     *
     * @param string $horarioViernes
     * @return ResumenMedia
     */
    public function setHorarioViernes($horarioViernes)
    {
        $this->horario_viernes = $horarioViernes;
    
        return $this;
    }

    /**
     * Get horario_viernes
     *
     * @return string 
     */
    public function getHorarioViernes()
    {
        return $this->horario_viernes;
    }

    /**
     * Set fila
     *
     * @param integer $fila
     * @return ResumenMedia
     */
    public function setFila($fila)
    {
        $this->fila = $fila;
    
        return $this;
    }

    /**
     * Get fila
     *
     * @return integer 
     */
    public function getFila()
    {
        return $this->fila;
    }
}