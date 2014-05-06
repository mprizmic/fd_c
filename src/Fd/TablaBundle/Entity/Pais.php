<?php
namespace Fd\TablaBundle\Entity;

use Fd\TablaBundle\Entity\Pais;
use Fd\TablaBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="pais")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\PaisRepository")
 */
class Pais
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=3)
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
    
//    /**
//     * @ORM\OneToMany(targetEntity="Alumno", mappedBy="nacionalidad")
//     */
//    protected $sujetos_nacionalidad;
//    
//    /**
//     * @ORM\OneToMany(targetEntity="Alumno", mappedBy="paisNacimiento")
//     */
//    protected $sujetos_nacimiento;    
//    
//    public function __construct() {
//        $this->sujetos_nacionalidad = new ArrayCollection();
//        $this->sujetos_nacimiento = new ArrayCollection();
//    }

    public function __toString(){
        return $this->getDescripcion();
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
}