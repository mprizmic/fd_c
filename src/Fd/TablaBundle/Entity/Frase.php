<?php

namespace Fd\TablaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="frase")
 * @ORM\Entity(repositoryClass="Fd\TablaBundle\Repository\FraseRepository")
 */
class Frase {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    protected $frase;

    /**
     * @ORM\Column(type="date")
     */
    protected $fecha;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $autor;

    public function __toString() {
        return $this->getFrase();
    }

    public function __construct() {
        $this->fecha = new \DateTime('now');
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
     * Set frase
     *
     * @param string $frase
     * @return Frase
     */
    public function setFrase($frase)
    {
        $this->frase = $frase;

        return $this;
    }

    /**
     * Get frase
     *
     * @return string 
     */
    public function getFrase()
    {
        return $this->frase;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Frase
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set autor
     *
     * @param string $autor
     * @return Frase
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }
}
