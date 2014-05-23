<?php

namespace Fd\TablaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fd\TablaBundle\Entity\OrigenHora
 *
 * @ORM\Table(name="origen_hora")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\OrigenHoraRepository")
 */
class OrigenHora
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
     * @ORM\Column(type="integer", nullable=false)
     */
    private $codigo;
    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $descripcion;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso", mappedBy="origen_hora")
     */
    private $establecimiento_recursos;    
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
    public function __toString() {
        return $this->getDescripcion();
    }
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();        
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
     * @param integer $codigo
     * @return OrigenHora
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return OrigenHora
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
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
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return OrigenHora
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
     * @return OrigenHora
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
     * Add establecimiento_recursos
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimientoRecursos
     * @return OrigenHora
     */
    public function addEstablecimientoRecurso(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimientoRecursos)
    {
        $this->establecimiento_recursos[] = $establecimientoRecursos;
    
        return $this;
    }

    /**
     * Remove establecimiento_recursos
     *
     * @param \Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimientoRecursos
     */
    public function removeEstablecimientoRecurso(\Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso $establecimientoRecursos)
    {
        $this->establecimiento_recursos->removeElement($establecimientoRecursos);
    }

    /**
     * Get establecimiento_recursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstablecimientoRecursos()
    {
        return $this->establecimiento_recursos;
    }
}