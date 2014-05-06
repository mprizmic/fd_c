<?php

namespace Fd\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Fd\UsuarioBundle\Entity\UsuarioRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Usuario implements UserInterface {

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
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $apellido;

    /**
     * @ORM\Column(length=100, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(length=100)
     * @Assert\NotBlank(message="No puede dejar el usuario en vacío")
     */
    private $nombre_usuario;

    /**
     * @ORM\Column(length=255)
     * @Assert\Range(min="3")
     */
    private $password;

    /**
     * @ORM\Column(length=255)
     */
    private $salt;

    /**
     * @ORM\Column(length=255, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $permite_mail;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date()
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Date()
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(length=10, nullable=true)
     */
    private $dni;

    /**
     * @ORM\Column(length=25, nullable=false)
     */
    private $rol;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $conexion_actual;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $conexion_anterior;
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
   

    public function __construct() {
        $this->fecha_alta = new \DateTime();
        $this->permite_mail = false;
        $this->creado = new \DateTime();
        $this->actualizado = new \DateTime();
        
    }

    public function __toString() {
        return $this->getApellido() . ', ' . $this->getNombre();
    }

    function equals(UserInterface $usuario) {
        return $this->getNombreUsuario() == $usuario->getNombreUsuario();
    }

    function eraseCredentials() {
        
    }

    function getRoles() {
        return array($this->getRol());
        
    }

    function getUsername() {
        return $this->getNombreUsuario();
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
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
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
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Set nombre_usuario
     *
     * @param string $nombreUsuario
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombre_usuario = $nombreUsuario;
    }

    /**
     * Get nombre_usuario
     *
     * @return string 
     */
    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set permite_mail
     *
     * @param boolean $permiteMail
     */
    public function setPermiteMail($permiteMail)
    {
        $this->permite_mail = $permiteMail;
    }

    /**
     * Get permite_mail
     *
     * @return boolean 
     */
    public function getPermiteMail()
    {
        return $this->permite_mail;
    }

    /**
     * Set fecha_alta
     *
     * @param datetime $fechaAlta
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fecha_alta = $fechaAlta;
    }

    /**
     * Get fecha_alta
     *
     * @return datetime 
     */
    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param datetime $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return datetime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set dni
     *
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set rol
     *
     * @param string $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * Get rol
     *
     * @return string 
     */
    public function getRol()
    {
        return $this->rol;
    }


    /**
     * Set conexion_actual
     *
     * @param \DateTime $conexionActual
     * @return Usuario
     */
    public function setConexionActual($conexionActual)
    {
        $this->conexion_actual = $conexionActual;
    
        return $this;
    }

    /**
     * Get conexion_actual
     *
     * @return \DateTime 
     */
    public function getConexionActual()
    {
        return $this->conexion_actual;
    }

    /**
     * Set conexion_anterior
     *
     * @param \DateTime $conexionAnterior
     * @return Usuario
     */
    public function setConexionAnterior($conexionAnterior)
    {
        $this->conexion_anterior = $conexionAnterior;
    
        return $this;
    }

    /**
     * Get conexion_anterior
     *
     * @return \DateTime 
     */
    public function getConexionAnterior()
    {
        return $this->conexion_anterior;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Usuario
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
     * @return Usuario
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