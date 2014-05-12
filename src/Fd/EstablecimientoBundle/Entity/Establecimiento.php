<?php

namespace Fd\EstablecimientoBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\EstablecimientoBundle\Validator\Constraints as FdAssert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fd\EstablecimientoBundle\Entity\Establecimiento
 *
 * @ORM\Table(name="establecimiento")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\EstablecimientoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Establecimiento {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $cue
     *
     * @ORM\Column(name="cue", type="string", length=7, nullable=true)
     */
    private $cue;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio", mappedBy="establecimientos")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $edificio;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\TipoEstablecimiento")
     */
    private $tipo_establecimiento;

    /**
     *
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $codigo_previo_transferencia;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(length=25, nullable=true)
     */
    private $apodo;

    /**
     * @var string $numero
     *
     * @ORM\Column(name="numero", type="integer", length=2, nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(name="orden", type="integer", length=2, nullable=true)
     */
    private $orden;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=15, nullable=true)
     */
    private $descripcion;

    /**
     *
     * @ORM\Column(type="date", nullable=true)        hacer que se puedan guardar los temas de infraestructura y guardar adjuntos
     */
    private $fecha_creacion;

    /**
     *
     * @ORM\Column(name="tiene_cooperadora", type="string", length=2, nullable=true)
     * @FdAssert\Sinosd
     */
    private $tiene_cooperadora;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string $url
     *
     * @ORM\Column(nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\CargoAutoridad")
     */
    private $cargo_autoridad;

    /**
     * @ORM\Column(nullable=true)
     */
    private $nombre_autoridad;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\DistritoEscolar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrito_escolar_id", referencedColumnName="id")
     * })
     */
    private $distrito_escolar;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Sector")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sector_id", referencedColumnName="id")
     * })
     */
    private $sector;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadEducativa", mappedBy="establecimiento")
     */
    private $unidades_educativas;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\Autoridad", mappedBy="establecimiento")
     */
    private $autoridades_rectorado;

    /**
     * domicilio del campo de deportes
     * @ORM\Column(nullable=true, length=25)
     */
    private $campo_deportes;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_presentacion_roi;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_roi;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_presentacion_ram;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_ram;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_presentacion_rp;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_rp;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_elecciones;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fin_mandato;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\Column(length=4)
     */
    private $anio_inicio_nes;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso", mappedBy="establecimiento")
     * @Assert\NotBlank(message="El dato no puede quedar en blanco")
     */
    private $recursos;
    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $actualizado;
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * 
     */
    private $te;
    /**
     * recuprea el edificio principal que tiene anexo 00. Es un objeto establecimiento_edificio No se si dedería estar sólo en el repository
     * 
     * @return type
     */
    public function getEdificioPrincipal() {
        $el_principal = null;
        foreach ($this->getEdificio() as $un_edificio) {
            if ($un_edificio->getCueAnexo() == '00') {
                $el_principal = $un_edificio;
                break;
            }
        };
        return $el_principal;
    }

    /**
     * Toma la comuna del edificio principal del establecimiento
     * 
     */
    public function getComuna() {
        $comuna = $this->getEdificioPrincipal()->getEdificios()->getComuna();
        return $comuna;
    }
    /**
     * Toma el CGP del edificio principal del establecimiento
     * 
     */
    public function getCgp() {
        
        return $this->getEdificioPrincipal()->getEdificios()->getCgp();
    }

    /**
     * devuelve la unidad educativa de nivel terciario
     * @return type
     */
    public function getTerciario() {
        foreach ($this->getUnidadesEducativas() as $unidad) {
            if ($unidad->getNivel()->getAbreviatura() == 'Ter') {
                return $unidad;
            }
        };
    }

    /**
     * 
     * @param type $nivel Es un string con la abreviatura del nivel
     * @return null 
     */
    public function getUnidadEducativa($nivel) {
        foreach ($this->getUnidadesEducativas() as $unidad) {
            if ($unidad->getNivel()->getAbreviatura() == $nivel) {
                return $unidad;
            }
        };
        return null;
    }

    public function getAutoridad() {
        return $this->cargo_autoridad . ': ' . $this->nombre_autoridad;
    }

    /**
     * Devuelve el no de anexo más alto que esté registrado
     * @return type
     */
    public function getMayorAnexo() {
        //tomo la colección de edificios y le busco el de mayor # de anexo
        $anexos = $this->getEdificio();
        $max = "00";
        foreach ($anexos as $establecimiento_edificio) {
            $este = $establecimiento_edificio->getCueAnexo();
            if ($este > $max) {
                $max = $este;
            };
        };
        return $max;
    }

    /**
     * Al mayor nro de anexo que esté registrado le suma 1
     * Devuelve una sarta de 2 caracteres con "0" a la izquierda
     * 
     * @return type
     */
    public function getNroNuevoAnexo() {
        $max = $this->getMayorAnexo();
        //le sumo 1 al mayor nro de anexo existente
        $max = substr(str_pad(strval($max + 1), 3, "0", STR_PAD_LEFT), 1, 2);
        return $max;
    }

    /**
     * Verifica si un valor dado ya está siendo usado como nro de anexo
     * 
     * @param type $valor
     */
    public function esAnexo($valor) {
        $anexos = $this->getEdificio();
        foreach ($anexos as $establecimiento_edificio) {
            $anexo = $establecimiento_edificio->getCueAnexo();
            if ($anexo == $valor)
                return true;
        };
        return false;
    }

    public function __toString() {
        if ($this->apodo){
            return $this->apodo;
        };
        return '';
    }

    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion() {
        $this->setActualizado(new \DateTime());
    }

    public function __construct() {
        $this->edificio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
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
     * Set cue
     *
     * @param string $cue
     */
    public function setCue($cue) {
        $this->cue = $cue;
    }

    /**
     * Get cue
     *
     * @return string 
     */
    public function getCue() {
        return $this->cue;
    }

    /**
     * Set codigo_previo_transferencia
     *
     * @param string $codigoPrevioTransferencia
     */
    public function setCodigoPrevioTransferencia($codigoPrevioTransferencia) {
        $this->codigo_previo_transferencia = $codigoPrevioTransferencia;
    }

    /**
     * Get codigo_previo_transferencia
     *
     * @return string 
     */
    public function getCodigoPrevioTransferencia() {
        return $this->codigo_previo_transferencia;
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
     * Set apodo
     *
     * @param string $apodo
     */
    public function setApodo($apodo) {
        $this->apodo = $apodo;
    }

    /**
     * Get apodo
     *
     * @return string 
     */
    public function getApodo() {
        return $this->apodo;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     */
    public function setNumero($numero) {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     */
    public function setOrden($orden) {
        $this->orden = $orden;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden() {
        return $this->orden;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
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
     * Set tiene_cooperadora
     *
     * @param boolean $tieneCooperadora
     */
    public function setTieneCooperadora($tieneCooperadora) {
        $this->tiene_cooperadora = $tieneCooperadora;
    }

    /**
     * Get tiene_cooperadora
     *
     * @return boolean 
     */
    public function getTieneCooperadora() {
        return $this->tiene_cooperadora;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set nombre_autoridad
     *
     * @param string $nombreAutoridad
     */
    public function setNombreAutoridad($nombreAutoridad) {
        $this->nombre_autoridad = $nombreAutoridad;
    }

    /**
     * Get nombre_autoridad
     *
     * @return string 
     */
    public function getNombreAutoridad() {
        return $this->nombre_autoridad;
    }

    /**
     * Add edificio
     *
     * @param Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $edificio
     */
    public function addEstablecimientoEdificio(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $edificio) {
        $this->edificio[] = $edificio;
    }

    /**
     * Get edificio
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEdificio() {
        return $this->edificio;
    }

    /**
     * Set tipo_establecimiento
     *
     * @param Fd\TablaBundle\Entity\TipoEstablecimiento $tipoEstablecimiento
     */
    public function setTipoEstablecimiento(\Fd\TablaBundle\Entity\TipoEstablecimiento $tipoEstablecimiento) {
        $this->tipo_establecimiento = $tipoEstablecimiento;
    }

    /**
     * Get tipo_establecimiento
     *
     * @return Fd\TablaBundle\Entity\TipoEstablecimiento 
     */
    public function getTipoEstablecimiento() {
        return $this->tipo_establecimiento;
    }

    /**
     * Set cargo_autoridad
     *
     * @param Fd\TablaBundle\Entity\CargoAutoridad $cargoAutoridad
     */
    public function setCargoAutoridad(\Fd\TablaBundle\Entity\CargoAutoridad $cargoAutoridad) {
        $this->cargo_autoridad = $cargoAutoridad;
    }

    /**
     * Get cargo_autoridad
     *
     * @return Fd\TablaBundle\Entity\CargoAutoridad 
     */
    public function getCargoAutoridad() {
        return $this->cargo_autoridad;
    }

    /**
     * Set distrito_escolar
     *
     * @param Fd\TablaBundle\Entity\DistritoEscolar $distritoEscolar
     */
    public function setDistritoEscolar(\Fd\TablaBundle\Entity\DistritoEscolar $distritoEscolar) {
        $this->distrito_escolar = $distritoEscolar;
    }

    /**
     * Get distrito_escolar
     *
     * @return Fd\TablaBundle\Entity\DistritoEscolar 
     */
    public function getDistritoEscolar() {
        return $this->distrito_escolar;
    }

    /**
     * Set sector
     *
     * @param Fd\TablaBundle\Entity\Sector $sector
     */
    public function setSector(\Fd\TablaBundle\Entity\Sector $sector) {
        $this->sector = $sector;
    }

    /**
     * Get sector
     *
     * @return Fd\TablaBundle\Entity\Sector 
     */
    public function getSector() {
        return $this->sector;
    }

    /**
     * Add unidades_educativas
     *
     * @param Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadesEducativas
     */
    public function addUnidadEducativa(\Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadesEducativas) {
        $this->unidades_educativas[] = $unidadesEducativas;
    }

    /**
     * Get unidades_educativas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUnidadesEducativas() {
        return $this->unidades_educativas;
    }

    /**
     * Add autoridades_rectorado
     *
     * @param Fd\EstablecimientoBundle\Entity\Autoridad $autoridadesRectorado
     */
    public function addAutoridad(\Fd\EstablecimientoBundle\Entity\Autoridad $autoridadesRectorado) {
        $this->autoridades_rectorado[] = $autoridadesRectorado;
    }

    /**
     * Get autoridades_rectorado
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAutoridadesRectorado() {
        return $this->autoridades_rectorado;
    }

    /**
     * Set campo_deportes
     *
     * @param string $campoDeportes
     * @return Establecimiento
     */
    public function setCampoDeportes($campoDeportes) {
        $this->campo_deportes = $campoDeportes;

        return $this;
    }

    /**
     * Get campo_deportes
     *
     * @return string 
     */
    public function getCampoDeportes() {
        return $this->campo_deportes;
    }

    /**
     * Add edificio
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $edificio
     * @return Establecimiento
     */
    public function addEdificio(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $edificio) {
        $this->edificio[] = $edificio;

        return $this;
    }

    /**
     * Remove edificio
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $edificio
     */
    public function removeEdificio(\Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio $edificio) {
        $this->edificio->removeElement($edificio);
    }

    /**
     * Add unidades_educativas
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadesEducativas
     * @return Establecimiento
     */
    public function addUnidadesEducativa(\Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadesEducativas) {
        $this->unidades_educativas[] = $unidadesEducativas;

        return $this;
    }

    /**
     * Remove unidades_educativas
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadesEducativas
     */
    public function removeUnidadesEducativa(\Fd\EstablecimientoBundle\Entity\UnidadEducativa $unidadesEducativas) {
        $this->unidades_educativas->removeElement($unidadesEducativas);
    }

    /**
     * Add autoridades_rectorado
     *
     * @param \Fd\EstablecimientoBundle\Entity\Autoridad $autoridadesRectorado
     * @return Establecimiento
     */
    public function addAutoridadesRectorado(\Fd\EstablecimientoBundle\Entity\Autoridad $autoridadesRectorado) {
        $this->autoridades_rectorado[] = $autoridadesRectorado;

        return $this;
    }

    /**
     * Remove autoridades_rectorado
     *
     * @param \Fd\EstablecimientoBundle\Entity\Autoridad $autoridadesRectorado
     */
    public function removeAutoridadesRectorado(\Fd\EstablecimientoBundle\Entity\Autoridad $autoridadesRectorado) {
        $this->autoridades_rectorado->removeElement($autoridadesRectorado);
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Establecimiento
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
     * Set creado
     *
     * @param \DateTime $creado
     * @return Establecimiento
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
     * Set fecha_presentacion_roi
     *
     * @param \DateTime $fechaPresentacionRoi
     * @return Establecimiento
     */
    public function setFechaPresentacionRoi($fechaPresentacionRoi) {
        $this->fecha_presentacion_roi = $fechaPresentacionRoi;

        return $this;
    }

    /**
     * Get fecha_presentacion_roi
     *
     * @return \DateTime 
     */
    public function getFechaPresentacionRoi() {
        return $this->fecha_presentacion_roi;
    }

    /**
     * Set fecha_aprobacion_roi
     *
     * @param \DateTime $fechaAprobacionRoi
     * @return Establecimiento
     */
    public function setFechaAprobacionRoi($fechaAprobacionRoi) {
        $this->fecha_aprobacion_roi = $fechaAprobacionRoi;

        return $this;
    }

    /**
     * Get fecha_aprobacion_roi
     *
     * @return \DateTime 
     */
    public function getFechaAprobacionRoi() {
        return $this->fecha_aprobacion_roi;
    }

    /**
     * Set fecha_elecciones
     *
     * @param \DateTime $fechaElecciones
     * @return Establecimiento
     */
    public function setFechaElecciones($fechaElecciones) {
        $this->fecha_elecciones = $fechaElecciones;

        return $this;
    }

    /**
     * Get fecha_elecciones
     *
     * @return \DateTime 
     */
    public function getFechaElecciones() {
        return $this->fecha_elecciones;
    }

    /**
     * Set fin_mandato
     *
     * @param \DateTime $finMandato
     * @return Establecimiento
     */
    public function setFinMandato($finMandato) {
        $this->fin_mandato = $finMandato;

        return $this;
    }

    /**
     * Get fin_mandato
     *
     * @return \DateTime 
     */
    public function getFinMandato() {
        return $this->fin_mandato;
    }

    /**
     * Set comparte_edificio
     *
     * @param boolean $comparteEdificio
     * @return Establecimiento
     */
    public function setComparteEdificio($comparteEdificio) {
        $this->comparte_edificio = $comparteEdificio;

        return $this;
    }

    /**
     * Get comparte_edificio
     *
     * @return boolean 
     */
    public function getComparteEdificio() {
        return $this->comparte_edificio;
    }

    /**
     * Set fecha_presentacion_ram
     *
     * @param \DateTime $fechaPresentacionRam
     * @return Establecimiento
     */
    public function setFechaPresentacionRam($fechaPresentacionRam) {
        $this->fecha_presentacion_ram = $fechaPresentacionRam;

        return $this;
    }

    /**
     * Get fecha_presentacion_ram
     *
     * @return \DateTime 
     */
    public function getFechaPresentacionRam() {
        return $this->fecha_presentacion_ram;
    }

    /**
     * Set fecha_aprobacion_ram
     *
     * @param \DateTime $fechaAprobacionRam
     * @return Establecimiento
     */
    public function setFechaAprobacionRam($fechaAprobacionRam) {
        $this->fecha_aprobacion_ram = $fechaAprobacionRam;

        return $this;
    }

    /**
     * Get fecha_aprobacion_ram
     *
     * @return \DateTime 
     */
    public function getFechaAprobacionRam() {
        return $this->fecha_aprobacion_ram;
    }

    /**
     * Set fecha_presentacion_rp
     *
     * @param \DateTime $fechaPresentacionRp
     * @return Establecimiento
     */
    public function setFechaPresentacionRp($fechaPresentacionRp) {
        $this->fecha_presentacion_rp = $fechaPresentacionRp;

        return $this;
    }

    /**
     * Get fecha_presentacion_rp
     *
     * @return \DateTime 
     */
    public function getFechaPresentacionRp() {
        return $this->fecha_presentacion_rp;
    }

    /**
     * Set fecha_aprobacion_rp
     *
     * @param \DateTime $fechaAprobacionRp
     * @return Establecimiento
     */
    public function setFechaAprobacionRp($fechaAprobacionRp) {
        $this->fecha_aprobacion_rp = $fechaAprobacionRp;

        return $this;
    }

    /**
     * Get fecha_aprobacion_rp
     *
     * @return \DateTime 
     */
    public function getFechaAprobacionRp() {
        return $this->fecha_aprobacion_rp;
    }

    /**
     * Set anio_inicio_nes
     *
     * @param integer $anioInicioNes
     * @return Establecimiento
     */
    public function setAnioInicioNes($anioInicioNes) {
        $this->anio_inicio_nes = $anioInicioNes;

        return $this;
    }

    /**
     * Get anio_inicio_nes
     *
     * @return integer 
     */
    public function getAnioInicioNes() {
        return $this->anio_inicio_nes;
    }


    /**
     * Set te
     *
     * @param string $te
     * @return Establecimiento
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
     * Add recursos
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos
     * @return Establecimiento
     */
    public function addRecurso(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos)
    {
        $this->recursos[] = $recursos;
    
        return $this;
    }

    /**
     * Remove recursos
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos
     */
    public function removeRecurso(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos)
    {
        $this->recursos->removeElement($recursos);
    }

    /**
     * Get recursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecursos()
    {
        return $this->recursos;
    }
}