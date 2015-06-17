<?php

namespace Fd\EdificioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="inspector")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Fd\EdificioBundle\Entity\InspectorRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Inspector {

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
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     */
    private $apellido;

    /**
     * @ORM\Column(length=100, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(length=30)
     * @Assert\NotBlank(message="No puede dejar el TE vacío")
     */
    private $te;
    /**
     * bidireccional lado inverso
     * @ORM\OneToMany(targetEntity="Fd\EdificioBundle\Entity\Edificio", mappedBy="inspector")
     */
    private $edificios;

    /**
     * @ORM\Column(type="datetime")
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
    public function datosCompletos(){
        return $this->__toString()
                . ' - TE: ' .
                $this->te
                . ' - email: ' .
                $this->email;
    }
   

    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
        
    }

    public function __toString() {
        return $this->getApellido() . ', ' . $this->getNombre();
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
     * @return Inspector
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
     * Set apellido
     *
     * @param string $apellido
     * @return Inspector
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Inspector
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set te
     *
     * @param string $te
     * @return Inspector
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
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Inspector
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
     * @return Inspector
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
     * Add edificios
     *
     * @param \Fd\EdificioBundle\Entity\Edificio $edificios
     * @return Inspector
     */
    public function addEdificio(\Fd\EdificioBundle\Entity\Edificio $edificios)
    {
        $this->edificios[] = $edificios;

        return $this;
    }

    /**
     * Remove edificios
     *
     * @param \Fd\EdificioBundle\Entity\Edificio $edificios
     */
    public function removeEdificio(\Fd\EdificioBundle\Entity\Edificio $edificios)
    {
        $this->edificios->removeElement($edificios);
    }

    /**
     * Get edificios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEdificios()
    {
        return $this->edificios;
    }
}
