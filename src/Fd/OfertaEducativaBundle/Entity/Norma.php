<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Fd\TablaBundle\Entity\TipoNorma;

/**
 * @ORM\Table(name="norma")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\NormaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Norma {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\TipoNorma")
     */
    private $tipo_norma;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Max(limit="2050")
     * @Assert\Min(limit="1920")
     */
    private $anio;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * bidireccional lado inverso
     * @ORM\ManyToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\OfertaEducativa", mappedBy="normas")
     * @ORM\JoinTable(name="oferta_norma", 
     *      joinColumns={@ORM\JoinColumn(name="norma_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="oferta_id", referencedColumnName="id")}
     * )
     */
    private $ofertas;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Norma", inversedBy="es_referenciada")
     * @ORM\JoinTable(name="norma_referencias", 
     *      joinColumns={@ORM\JoinColumn(name="norma_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="referencia_id", referencedColumnName="id")}
     * )
     */
    private $referencia_a;

    /**
     * bidireccional lado inverso
     * @ORM\ManyToMany(targetEntity="norma", mappedBy="referencia_a")
     */
    private $es_referenciada;
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
        $this->ofertas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referencia_a = new \Doctrine\Common\Collections\ArrayCollection();
        $this->es_referenciada = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();        
    }

    public function __toString() {
        return $this->getNumero() . '/' . $this->getTipoNorma()->getCodigo() . '/' . $this->getAnio();
    }

    public function getCompleta() {
        return $this->getNumero() . '/' . $this->getTipoNorma()->getCodigo() . '/' . $this->getAnio() . ' ' . $this->getDescripcion();
    }

    public function etiqueta() {
        return 'Norma';
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
     * Set anio
     *
     * @param integer $anio
     */
    public function setAnio($anio) {
        $this->anio = $anio;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio() {
        return $this->anio;
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
     * Set tipo_norma
     *
     * @param Fd\TablaBundle\Entity\TipoNorma $tipoNorma
     */
    public function setTipoNorma(\Fd\TablaBundle\Entity\TipoNorma $tipoNorma) {
        $this->tipo_norma = $tipoNorma;
    }

    /**
     * Get tipo_norma
     *
     * @return Fd\TablaBundle\Entity\TipoNorma 
     */
    public function getTipoNorma() {
        return $this->tipo_norma;
    }

    /**
     * Add ofertas
     *
     * @param Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas
     */
    public function addOfertaEducativa(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas) {
        $this->ofertas[] = $ofertas;
    }

    /**
     * Get ofertas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOfertas() {
        return $this->ofertas;
    }

    /**
     * Set sacar
     *
     * @param integer $sacar
     */
    public function setSacar($sacar) {
        $this->sacar = $sacar;
    }

    /**
     * Get sacar
     *
     * @return integer 
     */
    public function getSacar() {
        return $this->sacar;
    }

    /**
     * Add ofertas
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas
     * @return Norma
     */
    public function addOferta(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas) {
        $this->ofertas[] = $ofertas;

        return $this;
    }

    /**
     * Remove ofertas
     *
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas
     */
    public function removeOferta(\Fd\OfertaEducativaBundle\Entity\OfertaEducativa $ofertas) {
        $this->ofertas->removeElement($ofertas);
    }


    /**
     * Add referencia_a
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Norma $referenciaA
     * @return Norma
     */
    public function addReferenciaA(\Fd\OfertaEducativaBundle\Entity\Norma $referenciaA)
    {
        $this->referencia_a[] = $referenciaA;
    
        return $this;
    }

    /**
     * Remove referencia_a
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Norma $referenciaA
     */
    public function removeReferenciaA(\Fd\OfertaEducativaBundle\Entity\Norma $referenciaA)
    {
        $this->referencia_a->removeElement($referenciaA);
    }

    /**
     * Get referencia_a
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReferenciaA()
    {
        return $this->referencia_a;
    }

    /**
     * Add es_referenciada
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Norma $esReferenciada
     * @return Norma
     */
    public function addEsReferenciada(\Fd\OfertaEducativaBundle\Entity\Norma $esReferenciada)
    {
        $this->es_referenciada[] = $esReferenciada;
    
        return $this;
    }

    /**
     * Remove es_referenciada
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Norma $esReferenciada
     */
    public function removeEsReferenciada(\Fd\OfertaEducativaBundle\Entity\Norma $esReferenciada)
    {
        $this->es_referenciada->removeElement($esReferenciada);
    }

    /**
     * Get es_referenciada
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEsReferenciada()
    {
        return $this->es_referenciada;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Norma
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
     * @return Norma
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
}