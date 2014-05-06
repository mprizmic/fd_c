<?php

namespace Fd\ActoPublicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogActoPublico
 *
 * @ORM\Table(name="log_acto_publico")
 * @ORM\Entity(repositoryClass="Fd\ActoPublicoBundle\Repository\LogActoPublicoRepository")
 */
class LogActoPublico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="log", type="text")
     */
    private $log;
    
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return LogActoPublico
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
     * Set log
     *
     * @param string $log
     * @return LogActoPublico
     */
    public function setLog($log)
    {
        $this->log = $log;
    
        return $this;
    }

    /**
     * Get log
     *
     * @return string 
     */
    public function getLog()
    {
        return $this->log;
    }
}
