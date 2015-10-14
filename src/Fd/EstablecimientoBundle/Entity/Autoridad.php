<?php

namespace Fd\EstablecimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fd\TablaBundle\Entity\Cargo;
use Fd\EstablecimientoBundle\Validator\Constraints as ApellidoAssert;
/**
 * @ORM\Table(name="autoridad")
 * @ORM\Entity(repositoryClass="Fd\EstablecimientoBundle\Repository\AutoridadRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Autoridad
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
     * @ORM\Column(length=50, nullable=true)
     * @ApellidoAssert\Apellido
     */
    private $nombre;
    /**
     * @var string $nombre
     *
     * @ORM\Column(length=50, nullable=false)
     * @ApellidoAssert\Apellido
     */
    private $apellido;
    /**
     * @ORM\Column(length=50, nullable=true)
     */
    private $te_particular;
    /**
     * @ORM\Column(length=50, nullable=true)
     */
    private $celular;
    /**
     * @ORM\Column(length=50, nullable=true)
     * @Assert\Email(message="El email no es válido")
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Fd\TablaBundle\Entity\Cargo")
     */
    private $cargo;
    /**
     * bidireccional lado propietario
     * @ORM\ManyToOne(targetEntity="Establecimiento", inversedBy="autoridades_rectorado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })    
     * 
     */
    private $establecimiento;
    /**
     * @ORM\Column(nullable=true, type="date")
     * 
     */
    private $inicio_mandato;
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
    /**
     * @ORM\PrePersist  //en el persist cuando se da de alta uno nuevo
     * @ORM\PreUpdate //en el flush cuando se modifica uno existente
     */
    public function pasarAMayuscula()
    {
        $this->setApellido(strtoupper($this->getApellido()));
    }
    public function __construct() {
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
    }
    public function __toString() {
        return $this->getApellido() . ', ' . $this->getNombre();
    }

}
