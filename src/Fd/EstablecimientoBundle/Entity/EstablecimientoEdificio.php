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
     * @ORM\Column(nullable=true)
     */
    private $te1;

    /**
     * @ORM\Column(nullable=true)
     */
    private $te2;

    /**
     * @ORM\Column(nullable=true)
     */
    private $te3;

    /**
     * @ORM\Column(nullable=true)
     */
    private $email1;

    /**
     * @ORM\Column(nullable=true)
     */
    private $email2;

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
    public function isSede(){
        return ($this->getCueAnexo() == '00');
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set cue_anexo
     *
     * @param string $cueAnexo
     */
    public function setCueAnexo($cueAnexo) {
        $this->cue_anexo = $cueAnexo;
    }

    /**
     * Get cue_anexo
     *
     * @return string 
     */
    public function getCueAnexo() {
        return $this->cue_anexo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set fecha_creacion
     *
     * @param date $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fecha_creacion = $fechaCreacion;
    }

    /**
     * Get fecha_creacion
     *
     * @return date 
     */
    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    /**
     * Set fecha_baja
     *
     * @param date $fechaBaja
     */
    public function setFechaBaja($fechaBaja) {
        $this->fecha_baja = $fechaBaja;
    }

    /**
     * Get fecha_baja
     *
     * @return date 
     */
    public function getFechaBaja() {
        return $this->fecha_baja;
    }

    /**
     * Set te1
     *
     * @param string $te1
     */
    public function setTe1($te1) {
        $this->te1 = $te1;
    }

    /**
     * Get te1
     *
     * @return string 
     */
    public function getTe1() {
        return $this->te1;
    }

    /**
     * Set te2
     *
     * @param string $te2
     */
    public function setTe2($te2) {
        $this->te2 = $te2;
    }

    /**
     * Get te2
     *
     * @return string 
     */
    public function getTe2() {
        return $this->te2;
    }

    /**
     * Set te3
     *
     * @param string $te3
     */
    public function setTe3($te3) {
        $this->te3 = $te3;
    }

    /**
     * Get te3
     *
     * @return string 
     */
    public function getTe3() {
        return $this->te3;
    }

    /**
     * Set email1
     *
     * @param string $email1
     */
    public function setEmail1($email1) {
        $this->email1 = $email1;
    }

    /**
     * Get email1
     *
     * @return string 
     */
    public function getEmail1() {
        return $this->email1;
    }

    /**
     * Set email2
     *
     * @param string $email2
     */
    public function setEmail2($email2) {
        $this->email2 = $email2;
    }

    /**
     * Get email2
     *
     * @return string 
     */
    public function getEmail2() {
        return $this->email2;
    }

    /**
     * Set establecimientos
     *
     * @param Fd\EstablecimientoBundle\Entity\Establecimiento $establecimientos
     */
    public function setEstablecimientos(\Fd\EstablecimientoBundle\Entity\Establecimiento $establecimientos) {
        $this->establecimientos = $establecimientos;
    }

    /**
     * Get establecimientos
     *
     * @return Fd\EstablecimientoBundle\Entity\Establecimiento 
     */
    public function getEstablecimientos() {
        return $this->establecimientos;
    }

    /**
     * Set edificios
     *
     * @param Fd\EdificioBundle\Entity\Edificio $edificios
     */
    public function setEdificios(\Fd\EdificioBundle\Entity\Edificio $edificios) {
        $this->edificios = $edificios;
    }

    /**
     * Get edificios
     *
     * @return Fd\EdificioBundle\Entity\Edificio 
     */
    public function getEdificios() {
        return $this->edificios;
    }

    /**
     * Add localizacion
     *
     * @param Fd\EstablecimientoBundle\Entity\Localizacion $localizacion
     */
    public function addLocalizacion(\Fd\EstablecimientoBundle\Entity\Localizacion $localizacion) {
        $this->localizacion[] = $localizacion;
    }

    /**
     * Get localizacion
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocalizacion() {
        return $this->localizacion;
    }

}
