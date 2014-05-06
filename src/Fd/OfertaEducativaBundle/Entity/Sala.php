<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="sala")
 * @ORM\Entity
 */
class Sala {

    /**
     * 
     * @ORM\Column(name = "id", type = "integer", nullable = false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * lado propietario bidireccional
     * @ORM\ManyToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\InicialX", inversedBy="salas",  cascade={"persist", "remove"})
     * @Assert\NotBlank()
     */
    private $inicial_x;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var type 
     * Es la cantidad de secciones de un determinado grupo etario que tiene el nivel inicial de un establecimiento
     * @Assert\Range(min=1, minMessage="Dato inválido")
     */
    private $q_secciones;
    /**
     * lado propietario no bidireccional
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\GrupoEtario")
     */
    private $grupo_etario;

    public function __toString() {
        return $this->getGrupoEtario()->__toString();
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
     * Set q_secciones
     *
     * @param integer $qSecciones
     * @return Sala
     */
    public function setQSecciones($qSecciones)
    {
        $this->q_secciones = $qSecciones;
    
        return $this;
    }

    /**
     * Get q_secciones
     *
     * @return integer 
     */
    public function getQSecciones()
    {
        return $this->q_secciones;
    }

    /**
     * Set inicial_x
     *
     * @param \Fd\OfertaEducativaBundle\Entity\InicialX $inicialX
     * @return Sala
     */
    public function setInicialX(\Fd\OfertaEducativaBundle\Entity\InicialX $inicialX = null)
    {
        $this->inicial_x = $inicialX;
    
        return $this;
    }

    /**
     * Get inicial_x
     *
     * @return \Fd\OfertaEducativaBundle\Entity\InicialX 
     */
    public function getInicialX()
    {
        return $this->inicial_x;
    }

    /**
     * Set grupo_etario
     *
     * @param \Fd\TablaBundle\Entity\GrupoEtario $grupoEtario
     * @return Sala
     */
    public function setGrupoEtario(\Fd\TablaBundle\Entity\GrupoEtario $grupoEtario = null)
    {
        $this->grupo_etario = $grupoEtario;
    
        return $this;
    }

    /**
     * Get grupo_etario
     *
     * @return \Fd\TablaBundle\Entity\GrupoEtario 
     */
    public function getGrupoEtario()
    {
        return $this->grupo_etario;
    }
}