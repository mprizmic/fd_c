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

    const ETIQUETA = 'Establecimiento';

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
     * 
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
     * @ORM\Column(type="string", length=10, nullable=true)        
     * La longitud se la chequea en isFecha
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
    private $fecha_presentacion_rai;

    /**
     * @ORM\Column(nullable=true, type="date")
     */
    private $fecha_aprobacion_rai;

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
     * 
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
     * DEPRECATED en la localizacion de la oferta
     * 
     * Verifica si un establecimiento tiene la carrera asignada
     * @param type $carrera
     * @return boolean
     */
//    public function hasCarrera($carrera) {
//        $unidad_ofertas = $this->getUnidadEducativa('Ter')->getOfertas();
//        $oferta_educativa = $carrera->getOferta();
//        foreach ($unidad_ofertas as $unidad_oferta) {
//            if ($unidad_oferta->getOfertas()->getId() == $oferta_educativa->getId()) {
//                return true;
//            }
//        }
//        return false;
//    }

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
            if ($unidad->isTerciario()) {
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
        return $this->getApodo();
    }

    public function tiene_examen() {
        $tiene = false;
        $edificios = $this->getEdificio();
        foreach ($edificios as $key => $edificio) {
            $localizaciones = $edificio->getLocalizacion();
            foreach ($localizaciones as $key => $localizacion) {
                $unidad_ofertas = $localizacion->getOfertas();
                foreach ($unidad_ofertas as $key => $unidad_oferta) {
                    if ($unidad_oferta->getHasExamen()) {
                        $tiene = true;
                        break 3;
                    }
                }
            }
        }
        return $tiene;
    }

    /**
     * Chequea si la fecha de creación tiene formato de fecha
     * @Assert\True(message="La fecha de creación no tiene formato válido")
     */
    public function isFecha() {

        //esta asignacion se hace por un problema del empty de php
        $la_fecha = $this->fecha_creacion;

        if (empty($la_fecha)) {

            //si está vacía no se chequea el formato nila longitud
            return true;
        } else {
            if (strlen($la_fecha) > 0 and strlen($la_fecha) == 10) {
                return ( preg_match("/([0-9]{2})\-([0-9]{2})-([0-9]{4})/i", $this->fecha_creacion) ) ?
                        checkdate(substr($this->fecha_creacion, 3, 2), substr($this->fecha_creacion, 0, 2), substr($this->fecha_creacion, 6, 4)) :
                        false;
            } else {
                return false;
            }
        }
    }

    public function getRector() {
        $resultado = null;

        $todos = $this->getAutoridadesRectorado();

        foreach ($todos as $autoridad) {
            if ($autoridad->getCargoAutoridad()->getAbreviatura() == 'REC') {
                $resultado = $autoridad;
                break;
            }
        }
        return $resultado;
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
     * @return Establecimiento
     */
    public function setCue($cue) {
        $this->cue = $cue;

        return $this;
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
     * @return Establecimiento
     */
    public function setCodigoPrevioTransferencia($codigoPrevioTransferencia) {
        $this->codigo_previo_transferencia = $codigoPrevioTransferencia;

        return $this;
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
     * @return Establecimiento
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
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
     * @return Establecimiento
     */
    public function setApodo($apodo) {
        $this->apodo = $apodo;

        return $this;
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
     * @return Establecimiento
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
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
     * @return Establecimiento
     */
    public function setOrden($orden) {
        $this->orden = $orden;

        return $this;
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
     * @return Establecimiento
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
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
     * @param string $fechaCreacion
     * @return Establecimiento
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fecha_creacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fecha_creacion
     *
     * @return string 
     */
    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    /**
     * Set tiene_cooperadora
     *
     * @param string $tieneCooperadora
     * @return Establecimiento
     */
    public function setTieneCooperadora($tieneCooperadora) {
        $this->tiene_cooperadora = $tieneCooperadora;

        return $this;
    }

    /**
     * Get tiene_cooperadora
     *
     * @return string 
     */
    public function getTieneCooperadora() {
        return $this->tiene_cooperadora;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Establecimiento
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
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
     * Set fecha_presentacion_rai
     *
     * @param \DateTime $fechaPresentacionRai
     * @return Establecimiento
     */
    public function setFechaPresentacionRai($fechaPresentacionRai) {
        $this->fecha_presentacion_rai = $fechaPresentacionRai;

        return $this;
    }

    /**
     * Get fecha_presentacion_rai
     *
     * @return \DateTime 
     */
    public function getFechaPresentacionRai() {
        return $this->fecha_presentacion_rai;
    }

    /**
     * Set fecha_aprobacion_rai
     *
     * @param \DateTime $fechaAprobacionRai
     * @return Establecimiento
     */
    public function setFechaAprobacionRai($fechaAprobacionRai) {
        $this->fecha_aprobacion_rai = $fechaAprobacionRai;

        return $this;
    }

    /**
     * Get fecha_aprobacion_rai
     *
     * @return \DateTime 
     */
    public function getFechaAprobacionRai() {
        return $this->fecha_aprobacion_rai;
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
     * Get edificio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEdificio() {
        return $this->edificio;
    }

    /**
     * Set tipo_establecimiento
     *
     * @param \Fd\TablaBundle\Entity\TipoEstablecimiento $tipoEstablecimiento
     * @return Establecimiento
     */
    public function setTipoEstablecimiento(\Fd\TablaBundle\Entity\TipoEstablecimiento $tipoEstablecimiento = null) {
        $this->tipo_establecimiento = $tipoEstablecimiento;

        return $this;
    }

    /**
     * Get tipo_establecimiento
     *
     * @return \Fd\TablaBundle\Entity\TipoEstablecimiento 
     */
    public function getTipoEstablecimiento() {
        return $this->tipo_establecimiento;
    }

    /**
     * Set distrito_escolar
     *
     * @param \Fd\TablaBundle\Entity\DistritoEscolar $distritoEscolar
     * @return Establecimiento
     */
    public function setDistritoEscolar(\Fd\TablaBundle\Entity\DistritoEscolar $distritoEscolar = null) {
        $this->distrito_escolar = $distritoEscolar;

        return $this;
    }

    /**
     * Get distrito_escolar
     *
     * @return \Fd\TablaBundle\Entity\DistritoEscolar 
     */
    public function getDistritoEscolar() {
        return $this->distrito_escolar;
    }

    /**
     * Set sector
     *
     * @param \Fd\TablaBundle\Entity\Sector $sector
     * @return Establecimiento
     */
    public function setSector(\Fd\TablaBundle\Entity\Sector $sector = null) {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return \Fd\TablaBundle\Entity\Sector 
     */
    public function getSector() {
        return $this->sector;
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
     * Get unidades_educativas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidadesEducativas() {
        return $this->unidades_educativas;
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
     * Get autoridades_rectorado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutoridadesRectorado() {
        return $this->autoridades_rectorado;
    }

    /**
     * Add recursos
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos
     * @return Establecimiento
     */
    public function addRecurso(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos) {
        $this->recursos[] = $recursos;

        return $this;
    }

    /**
     * Remove recursos
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos
     */
    public function removeRecurso(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $recursos) {
        $this->recursos->removeElement($recursos);
    }

    /**
     * Get recursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecursos() {
        return $this->recursos;
    }

}
