<?php


namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Entity\Orientacion;
use Fd\OfertaEducativaBundle\Entity\TituloCarrera;
use Fd\OfertaEducativaBundle\Listener\CarreraListener;

/**
 * @ORM\Table(name="carrera")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\CarreraRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Carrera {
    
    const TIPO = "Carrera";

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", inversedBy="carrera")
     * @ORM\JoinColumn(name="oferta_educativa_id", referencedColumnName="id")
     */
    private $oferta;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\TipoFormacion")
     * @Assert\NotNull(message="El campo no puede quedar vacío.")
     */
    private $formacion;
    /**
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Disciplina")
     * @Assert\NotNull(message="La disciplina no puede estar vacía.")
     */
    private $disciplina;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\TituloCarrera", mappedBy="carrera", cascade={"persist", "remove"} )
     * @Assert\Valid()
     */
    private $titulos;

    /**
     * @ORM\Column(length=150, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duracion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(min=4, max=4)
     */
    private $anio_inicio;

    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Orientacion", mappedBy="carrera", cascade={"persist", "remove"} )
     * @Assert\Valid()
     */
    private $orientaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\EstadoCarrera")
     */
    private $estado;
    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $comentario;

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

    public function __toString() {
        return substr($this->nombre, 0, 60) . ' - ' . $this->getNorma();
    }

    public function getNorma(){
        $norma = "";
        foreach ($this->getOferta()->getNormas() as $value) {
            $norma = $value;
            break;
        };
        return $norma;
    }
    public function getIdentificacion() {
        return $this->nombre . ' - ' . $this->getEstado() . ' - ' . $this->getNorma();
    }

    /**
     * Escrito automático y arreglado por mi
     * Add orientaciones
     *
     * @param Fd\OfertaEducativaBundle\Entity\Orientacion $orientaciones
     */
    public function addOrientaciones(Orientacion $orientacion) {
        $orientacion->setCarrera($this);
        $this->orientaciones[] = $orientacion;
    }

    /**
     * Escrito por mi
     */
    public function removeOrientaciones(Orientacion $orientacion) {
        $this->orientaciones->removeElement($orientacion);
    }

    /**
     * Escrito por mi
     */
    public function setOrientaciones($orientaciones) {
        foreach ($orientaciones as $orientacion) {
            $orientacion->setCarrera($this);
        }
        $this->orientaciones = $orientaciones;
    }

    /**
     * Add titulos
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Titulo $titulos
     * @return Carrera
     */
    public function addTitulos(TituloCarrera $titulo) {
        $titulo->setCarrera($this);
        $this->titulos[] = $titulo;
    }

    /**
     * Remove titulos
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Titulo $titulos
     */
    public function removeTitulos(TituloCarrera $titulo) {
        $this->titulos->removeElement($titulo);
    }

    /**
     * Escrito por mi
     */
    public function setTitulos($titulos) {
        foreach ($titulos as $titulo) {
            $titulo->setCarrera($this);
        };
        $this->titulos = $titulos;
    }
    public function getTipo() {
        return self::TIPO;
    }

    public function __construct() {
        $this->orientaciones = new ArrayCollection();
        $this->titulos = new ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime('now');
        $this->anio_inicio = date("Y");
        $this->oferta = null;
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
     * @return Carrera
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
     * Set duracion
     *
     * @param string $duracion
     * @return Carrera
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set anio_inicio
     *
     * @param integer $anioInicio
     * @return Carrera
     */
    public function setAnioInicio($anioInicio)
    {
        $this->anio_inicio = $anioInicio;

        return $this;
    }

    /**
     * Get anio_inicio
     *
     * @return integer 
     */
    public function getAnioInicio()
    {
        return $this->anio_inicio;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Carrera
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Carrera
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
     * @return Carrera
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
     * Set oferta
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta
     * @return Carrera
     */
    public function setOferta(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta = null)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \Fd\OfertaEducativaBundle\Entity\OfertaEducativa 
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set formacion
     *
     * @param \Fd\TablaBundle\Entity\TipoFormacion $formacion
     * @return Carrera
     */
    public function setFormacion(\Fd\TablaBundle\Entity\TipoFormacion $formacion = null)
    {
        $this->formacion = $formacion;

        return $this;
    }

    /**
     * Get formacion
     *
     * @return \Fd\TablaBundle\Entity\TipoFormacion 
     */
    public function getFormacion()
    {
        return $this->formacion;
    }

    /**
     * Add titulos
     *
     * @param \Fd\OfertaEducativaBundle\Entity\TituloCarrera $titulos
     * @return Carrera
     */
    public function addTitulo(\Fd\OfertaEducativaBundle\Entity\TituloCarrera $titulos)
    {
        $this->titulos[] = $titulos;

        return $this;
    }

    /**
     * Remove titulos
     *
     * @param \Fd\OfertaEducativaBundle\Entity\TituloCarrera $titulos
     */
    public function removeTitulo(\Fd\OfertaEducativaBundle\Entity\TituloCarrera $titulos)
    {
        $this->titulos->removeElement($titulos);
    }

    /**
     * Get titulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTitulos()
    {
        return $this->titulos;
    }

    /**
     * Add orientaciones
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Orientacion $orientaciones
     * @return Carrera
     */
    public function addOrientacione(\Fd\OfertaEducativaBundle\Entity\Orientacion $orientaciones)
    {
        $this->orientaciones[] = $orientaciones;

        return $this;
    }

    /**
     * Remove orientaciones
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Orientacion $orientaciones
     */
    public function removeOrientacione(\Fd\OfertaEducativaBundle\Entity\Orientacion $orientaciones)
    {
        $this->orientaciones->removeElement($orientaciones);
    }

    /**
     * Get orientaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrientaciones()
    {
        return $this->orientaciones;
    }

    /**
     * Set estado
     *
     * @param \Fd\TablaBundle\Entity\EstadoCarrera $estado
     * @return Carrera
     */
    public function setEstado(\Fd\TablaBundle\Entity\EstadoCarrera $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Fd\TablaBundle\Entity\EstadoCarrera 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set disciplina
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Disciplina $disciplina
     * @return Carrera
     */
    public function setDisciplina(\Fd\OfertaEducativaBundle\Entity\Disciplina $disciplina = null)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get disciplina
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Disciplina 
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }
}
