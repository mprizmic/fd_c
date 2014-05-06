<?php
namespace Fd\TablaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="recurso")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\RecursoRepository")
 */
class Recurso
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $codigo;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $descripcion;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $orden;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso", mappedBy="recurso")
     */
    private $establecimiento;    

    public function __toString(){
        if ($this->descripcion){
            return $this->descripcion;
        };
        return '';
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
     * Set codigo
     *
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->establecimiento = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimiento
     * @return Recurso
     */
    public function addEstablecimiento(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimiento)
    {
        $this->establecimiento[] = $establecimiento;
    
        return $this;
    }

    /**
     * Remove establecimiento
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimiento
     */
    public function removeEstablecimiento(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimiento)
    {
        $this->establecimiento->removeElement($establecimiento);
    }

    /**
     * Get establecimiento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }
}