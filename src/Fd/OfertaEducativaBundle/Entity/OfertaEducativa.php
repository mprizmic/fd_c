<?php

namespace Fd\OfertaEducativaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use Fd\OfertaEducativaBundle\Entity\Norma;

/**
 * @ORM\Table(name="oferta_educativa")
 * @ORM\Entity(repositoryClass="Fd\OfertaEducativaBundle\Repository\OfertaEducativaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class OfertaEducativa {

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EstablecimientoBundle\Entity\UnidadOferta", mappedBy="ofertas")
     */
    private $unidades;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Nivel")
     */
    private $nivel;

    /**
     * lado inverso
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Carrera", mappedBy="oferta", cascade={"remove"})
     */
    private $carrera;

    /**
     * lado inverso
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Primario", mappedBy="oferta")
     */
    private $primario;

    /**
     * lado inverso
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Bachillerato", mappedBy="oferta")
     */
    private $bachillerato;

    /**
     * lado inverso
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Inicial", mappedBy="oferta")
     */
    private $inicial;

    /**
     * lado inverso
     * @ORM\OneToOne(targetEntity="Fd\OfertaEducativaBundle\Entity\Especializacion", mappedBy="oferta")
     */
    private $especializacion;

    /**
     * bidireccional lado propietario
     * @ORM\ManyToMany(targetEntity="Fd\OfertaEducativaBundle\Entity\Norma", inversedBy="ofertas")
     * @ORM\JoinTable(name="oferta_norma", 
     *      joinColumns={@ORM\JoinColumn(name="oferta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="norma_id", referencedColumnName="id")}
     * )
     */
    private $normas;
    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;
    /**
     * @ORM\Column(type="datetime")
     */
    private $actualizado;

    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function ultimaModificacion() {
        $this->setActualizado(new \DateTime());
    }

    public function __construct() {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->normas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
        $this->carrera = null;
    }

    public function __toString() {
        $entity = $this->getCarrera();
        if (is_null($entity)) {
            $entity = $this->getEspecializacion();
            if (is_null($entity)) {
                $entity = $this->getBachillerato();
                if (is_null($entity)) {
                    $entity = $this->getPrimario();
                    if (is_null($entity)) {
                        $entity = $this->getInicial();
                    }
                }
            }
        };
        return is_null($entity) ? 's/d' : $entity->__toString();
    }

    public function esTipo() {
        $tipo = "";
        $nombre = $this->getCarrera();
        if (is_null($nombre)) {
            $nombre = $this->getEspecializacion();
            if (is_null($nombre)) {
                $nombre = $this->getBachillerato();
                if (is_null($nombre)) {
                    $nombre = $this->getPrimario();
                    if (is_null($nombre)) {
                        $nombre = $this->getInicial();
                        if (is_null($nombre)) {
                            $nombre = 's/d';
                        } else {
                            $tipo = 'Inicial';
                        }
                    } else {
                        $tipo = 'Primario';
                    }
                } else {
                    $tipo = 'Bachillerato';
                }
            } else {
                $tipo = 'Especializacion';
            }
        } else {
            $tipo = 'Carrerea';
        };
        return $tipo;
    }

    /**
     * vincula una norma de esta oferta
     */
    public function vincularNorma($norma) {
        $this->addNorma($norma);
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
     * Add unidades
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $unidades
     * @return OfertaEducativa
     */
    public function addUnidade(\Fd\EstablecimientoBundle\Entity\UnidadOferta $unidades) {
        $this->unidades[] = $unidades;

        return $this;
    }

    /**
     * Remove unidades
     *
     * @param \Fd\EstablecimientoBundle\Entity\UnidadOferta $unidades
     */
    public function removeUnidade(\Fd\EstablecimientoBundle\Entity\UnidadOferta $unidades) {
        $this->unidades->removeElement($unidades);
    }

    /**
     * Get unidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidades() {
        return $this->unidades;
    }

    /**
     * Set nivel
     *
     * @param \Fd\TablaBundle\Entity\Nivel $nivel
     * @return OfertaEducativa
     */
    public function setNivel(\Fd\TablaBundle\Entity\Nivel $nivel = null) {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return \Fd\TablaBundle\Entity\Nivel 
     */
    public function getNivel() {
        return $this->nivel;
    }

    /**
     * Set carrera
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $carrera
     * @return OfertaEducativa
     */
    public function setCarrera(\Fd\OfertaEducativaBundle\Entity\Carrera $carrera = null) {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get carrera
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Carrera 
     */
    public function getCarrera() {
        return $this->carrera;
    }

    /**
     * Set primario
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Primario $primario
     * @return OfertaEducativa
     */
    public function setPrimario(\Fd\OfertaEducativaBundle\Entity\Primario $primario = null) {
        $this->primario = $primario;

        return $this;
    }

    /**
     * Get primario
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Primario 
     */
    public function getPrimario() {
        return $this->primario;
    }

    /**
     * Set bachillerato
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Bachillerato $bachillerato
     * @return OfertaEducativa
     */
    public function setBachillerato(\Fd\OfertaEducativaBundle\Entity\Bachillerato $bachillerato = null) {
        $this->bachillerato = $bachillerato;

        return $this;
    }

    /**
     * Get bachillerato
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Bachillerato 
     */
    public function getBachillerato() {
        return $this->bachillerato;
    }

    /**
     * Set inicial
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Inicial $inicial
     * @return OfertaEducativa
     */
    public function setInicial(\Fd\OfertaEducativaBundle\Entity\Inicial $inicial = null) {
        $this->inicial = $inicial;

        return $this;
    }

    /**
     * Get inicial
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Inicial 
     */
    public function getInicial() {
        return $this->inicial;
    }

    /**
     * Set especializacion
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Especializacion $especializacion
     * @return OfertaEducativa
     */
    public function setEspecializacion(\Fd\OfertaEducativaBundle\Entity\Especializacion $especializacion = null) {
        $this->especializacion = $especializacion;

        return $this;
    }

    /**
     * Get especializacion
     *
     * @return \Fd\OfertaEducativaBundle\Entity\Especializacion 
     */
    public function getEspecializacion() {
        return $this->especializacion;
    }

    /**
     * Add normas
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Norma $normas
     * @return OfertaEducativa
     */
    public function addNorma(\Fd\OfertaEducativaBundle\Entity\Norma $normas) {
        $this->normas[] = $normas;

        return $this;
    }

    /**
     * Remove normas
     *
     * @param \Fd\OfertaEducativaBundle\Entity\Norma $normas
     */
    public function removeNorma(\Fd\OfertaEducativaBundle\Entity\Norma $normas) {
        $this->normas->removeElement($normas);
    }

    /**
     * Get normas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNormas() {
        return $this->normas;
    }


    /**
     * Set j
     *
     * @param string $j
     * @return OfertaEducativa
     */
    public function setJ($j)
    {
        $this->j = $j;
    
        return $this;
    }

    /**
     * Get j
     *
     * @return string 
     */
    public function getJ()
    {
        return $this->j;
    }
    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return OfertaEducativa
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
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return OfertaEducativa
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
}