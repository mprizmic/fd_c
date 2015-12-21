<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio
 *
 * @ORM\Table(name="establecimiento_edificio")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\EstablecimientoEdificioRepository")
 */
class EstablecimientoEdificio {

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
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\Establecimiento", inversedBy="edificio")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $establecimientos;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EdificioBundle\Entity\Edificio", inversedBy="establecimiento")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $edificios;

    /**
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\Localizacion", mappedBy="establecimiento_edificio")
     * bidireccional lado inverso
     */
    private $localizacion;

    /**
     * @ORM\Column(name="cue_anexo", type="string", length=2, nullable=false)
     * @Assert\Length(min=2, max=2, exactMessage="El número de anexo debe tener 2 dígitos")
     */
    private $cue_anexo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_creacion;

    /**
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_baja;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\OrganizacionInterna", mappedBy="establecimiento")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $dependencias;

    /**
     * @ORM\Column(length=50, nullable=true)
     */
    private $te;
    /**
     * @ORM\Column(length=50, nullable=true)
     * @Assert\Email(message="El email no es válido")
     */
    private $email;    
    /**
     * devuelve el objeto localizacion de nivel terciario correspondiente $this
     */
    public function getTerciario() {
        foreach ($this->getLocalizacion() as $localizacion) {
            if ($localizacion->esTerciario()) {
                return $localizacion;
            }
        };
        return null;
    }

    /**
     * Si el edificio es sede devuelve true. Si es anexo devuelve false.
     * @return type
     */
    public function isSede() {
        return ($this->getCueAnexo() == '00');
    }
    public function strSede(){
        return $this->isSede()? 'Sede':'Anexo';
    }

    public function __toString() {
        return $this->getEstablecimientos()->getApodo() . ($this->getCueAnexo() == '00' ? '' : ' - ' . $this->getNombre());
    }

    public function getIdentificacion() {
        return $this->getEstablecimientos()->getNombre() . ($this->getCueAnexo() == '00' ? '' : ' - ' . $this->getNombre());
    }

    public function __construct() {
        $this->localizacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->establecimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->edificios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cue_anexo
     *
     * @param string $cueAnexo
     * @return EstablecimientoEdificio
     */
    public function setCueAnexo($cueAnexo)
    {
        $this->cue_anexo = $cueAnexo;

        return $this;
    }

    /**
     * Get cue_anexo
     *
     * @return string 
     */
    public function getCueAnexo()
    {
        return $this->cue_anexo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return EstablecimientoEdificio
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
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
     * Set fecha_creacion
     *
     * @param \DateTime $fechaCreacion
     * @return EstablecimientoEdificio
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fecha_creacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fecha_creacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * Set fecha_baja
     *
     * @param \DateTime $fechaBaja
     * @return EstablecimientoEdificio
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fecha_baja = $fechaBaja;

        return $this;
    }

    /**
     * Get fecha_baja
     *
     * @return \DateTime 
     */
    public function getFechaBaja()
    {
        return $this->fecha_baja;
    }

    /**
     * Set te
     *
     * @param string $te
     * @return EstablecimientoEdificio
     */
    public function setTe($te)
    {
        $this->te = $te;

        return $this;
    }

    /**
     * Get te
     *
     * @return string 
     */
    public function getTe()
    {
        return $this->te;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return EstablecimientoEdificio
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
     * Set establecimientos
     *
     * @param \Fd\EstablecimientoBundle\Entity\Establecimiento $establecimientos
     * @return EstablecimientoEdificio
     */
    public function setEstablecimientos(\Fd\EstablecimientoBundle\Entity\Establecimiento $establecimientos = null)
    {
        $this->establecimientos = $establecimientos;

        return $this;
    }

    /**
     * Get establecimientos
     *
     * @return \Fd\EstablecimientoBundle\Entity\Establecimiento 
     */
    public function getEstablecimientos()
    {
        return $this->establecimientos;
    }

    /**
     * Set edificios
     *
     * @param \Fd\EdificioBundle\Entity\Edificio $edificios
     * @return EstablecimientoEdificio
     */
    public function setEdificios(\Fd\EdificioBundle\Entity\Edificio $edificios = null)
    {
        $this->edificios = $edificios;

        return $this;
    }

    /**
     * Get edificios
     *
     * @return \Fd\EdificioBundle\Entity\Edificio 
     */
    public function getEdificios()
    {
        return $this->edificios;
    }

    /**
     * Add localizacion
     *
     * @param \Fd\EstablecimientoBundle\Entity\Localizacion $localizacion
     * @return EstablecimientoEdificio
     */
    public function addLocalizacion(\Fd\EstablecimientoBundle\Entity\Localizacion $localizacion)
    {
        $this->localizacion[] = $localizacion;

        return $this;
    }

    /**
     * Remove localizacion
     *
     * @param \Fd\EstablecimientoBundle\Entity\Localizacion $localizacion
     */
    public function removeLocalizacion(\Fd\EstablecimientoBundle\Entity\Localizacion $localizacion)
    {
        $this->localizacion->removeElement($localizacion);
    }

    /**
     * Get localizacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Add dependencias
     *
     * @param \Fd\EstablecimientoBundle\Entity\OrganizacionInterna $dependencias
     * @return EstablecimientoEdificio
     */
    public function addDependencia(\Fd\EstablecimientoBundle\Entity\OrganizacionInterna $dependencias)
    {
        $this->dependencias[] = $dependencias;

        return $this;
    }

    /**
     * Remove dependencias
     *
     * @param \Fd\EstablecimientoBundle\Entity\OrganizacionInterna $dependencias
     */
    public function removeDependencia(\Fd\EstablecimientoBundle\Entity\OrganizacionInterna $dependencias)
    {
        $this->dependencias->removeElement($dependencias);
    }

    /**
     * Get dependencias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDependencias()
    {
        return $this->dependencias;
    }
}
