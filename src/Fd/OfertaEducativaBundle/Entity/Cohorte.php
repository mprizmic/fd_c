<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\ExecutionContext;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cohorte")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\CohorteRepository")
 * @DoctrineAssert\UniqueEntity(fields={"unidad_oferta", "anio"}, message="No se pueden repetir el año y la oferta educativa.")
 * @Assert\Callback(methods={"esAnioGrande", "esCargaIncorrecta"})
 * @ORM\HasLifecycleCallbacks()
 */
class Cohorte {

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", inversedBy="cohortes", cascade={"remove", "persist"})
     */
    private $unidad_oferta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anio;

    /**
     * matricula total del RA
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matricula;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matricula_ingresantes;

    /**
     * incluye a la $matricula_ingresantes
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matricula_inicial;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matricula_final;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $egreso;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;
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
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();           
    }

    public function __toString() {
        return $this->getUnidadOferta() . ' - ' . $this->getAnio();
    }

    /**
     * No puede tener los 4 campos vacíos.
     * Si tiene al menos uno cargado valida bien.
     * 
     * @Assert\True(message="Debe ingresar al menos un valor")
     */
    public function isConAlgoCargado() {
        if ($this->matricula_inicial != 0 or
                $this->matricula_final != 0 or
                $this->matricula_ingresantes != 0 or
                $this->egreso != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return type
     */
    public function esAnioGrande(ExecutionContext $context) {
        $anio = date('Y') * 1;

        if ($this->anio > $anio) {
            $context->addViolationAtSubPath('anio', 'El año no puede ser mayor que el actual', array(), null);
        };
        if ($this->anio < $anio - 10) {
            $context->addViolationAtSubPath('anio', 'Está cargando datos demasiado antiguos. Verifíquelo.', array(), null);
        };
        return;
    }

    /**
     * Verifica las relaciones entre los nros de la matrícula
     * 
     * matricula ingresantes <= matricula inicial
     * matricula final <= matricula inicial
     * 
     * @return type
     */
    public function esCargaIncorrecta(ExecutionContext $context) {
        if ($this->matricula_final > 0 or $this->matricula_inicial > 0) {
            if ($this->matricula_final > $this->matricula_inicial) {
                $context->addViolationAtSubPath('matricula_final', 'La matrícula final no puede ser mayor que la inicial', array(), null);
            }
        };

//        if ($this->matricula_ingresantes > 0 or $this->matricula_inicial > 0) {
//            if ($this->matricula_ingresantes > $this->matricula_inicial) {
//                $context->addViolationAtSubPath('matricula_inicial', 'La matrícula de ingresantes no puede ser mayor que la martícula inicial', array(), null);
//            }
//        };
    }

    public function getDesgranamiento() {
        return $this->matricula_incial - $this->matricula_final;
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
     * Set anio
     *
     * @param integer $anio
     * @return Cohorte
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    
        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set matricula_ingresantes
     *
     * @param integer $matriculaIngresantes
     * @return Cohorte
     */
    public function setMatriculaIngresantes($matriculaIngresantes)
    {
        $this->matricula_ingresantes = $matriculaIngresantes;
    
        return $this;
    }

    /**
     * Get matricula_ingresantes
     *
     * @return integer 
     */
    public function getMatriculaIngresantes()
    {
        return $this->matricula_ingresantes;
    }

    /**
     * Set matricula_inicial
     *
     * @param integer $matriculaInicial
     * @return Cohorte
     */
    public function setMatriculaInicial($matriculaInicial)
    {
        $this->matricula_inicial = $matriculaInicial;
    
        return $this;
    }

    /**
     * Get matricula_inicial
     *
     * @return integer 
     */
    public function getMatriculaInicial()
    {
        return $this->matricula_inicial;
    }

    /**
     * Set matricula_final
     *
     * @param integer $matriculaFinal
     * @return Cohorte
     */
    public function setMatriculaFinal($matriculaFinal)
    {
        $this->matricula_final = $matriculaFinal;
    
        return $this;
    }

    /**
     * Get matricula_final
     *
     * @return integer 
     */
    public function getMatriculaFinal()
    {
        return $this->matricula_final;
    }

    /**
     * Set egreso
     *
     * @param integer $egreso
     * @return Cohorte
     */
    public function setEgreso($egreso)
    {
        $this->egreso = $egreso;
    
        return $this;
    }

    /**
     * Get egreso
     *
     * @return integer 
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Cohorte
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set unidad_oferta
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $unidadOferta
     * @return Cohorte
     */
    public function setUnidadOferta(\Fd\EstablecimientoBundle\Entity\UnidadOferta $unidadOferta = null)
    {
        $this->unidad_oferta = $unidadOferta;
    
        return $this;
    }

    /**
     * Get unidad_oferta
     *
     * @return \Fd\EstablecimientoBundle\Entity\UnidadOferta 
     */
    public function getUnidadOferta()
    {
        return $this->unidad_oferta;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Cohorte
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
     * @return Cohorte
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
     * Set matricula
     *
     * @param integer $matricula
     * @return Cohorte
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return integer 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }
}