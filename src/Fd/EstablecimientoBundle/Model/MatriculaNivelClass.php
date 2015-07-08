<?php

namespace Fd\EstablecimientoBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\TablaBundle\Entity\Nivel;

/**
 * ojeto del modelo
 * Sirve para cargar la matricula de cada nivel de un edificio de un establecimeito en particular
 */
class MatriculaNivelClass {

    /**
     * @var integer $id
     *
     */
    private $id;

    /**
     * @Assert\Type("integer")
     */
    private $matricula_inicial;

    /**
     * @Assert\Type("integer")
     */
    private $matricula_primario;

    /**
     * @Assert\Type("integer")
     */
    private $matricula_medio;

    /**
     * @Assert\Type("integer")
     */
    private $matricula_terciario;

    public function __construct(EstablecimientoEdificio $establecimiento_edificio) {

        // inicializo en 0
        $this->setMatriculaInicial(0);
        $this->setMatriculaPrimario(0);
        $this->setMatriculaMedio(0);
        $this->setMatriculaTerciario(0);

        $this->establecimiento_edificio = $establecimiento_edificio;
        $localizaciones = $establecimiento_edificio->getLocalizacion();
        
        // recorro todos  los niveles que se imparten en una localización
        foreach ($localizaciones as $localizacion) {
            $this->setMatricula( $localizacion->getUnidadEducativa()->getNivel()->getAbreviatura(), $localizacion->getMatricula());
        }
    }

    public function getEstablecimientoEdificio() {
        return $this->establecimiento_edificio;
    }

    public function getMatricula($nivel) {
        if ($nivel == 'Ini') {
            return $this->getMatriculaInicial();
        };
        if ($nivel == 'Pri') {
            return $this->getMatriculaPrimario();
        };
        if ($nivel == 'Med') {
            return $this->getMatriculaMedio();
        };
        if ($nivel == 'Ter') {
            return $this->getMatriculaTerciario();
        };
    }
    public function setMatricula($nivel, $matricula) {
        if ($nivel == 'Ini') {
            $this->setMatriculaInicial($matricula);
        };
        if ($nivel == 'Pri') {
            $this->setMatriculaPrimario($matricula);
        };
        if ($nivel == 'Med') {
            $this->setMatriculaMedio($matricula);
        };
        if ($nivel == 'Ter') {
            return $this->setMatriculaTerciario($matricula);
        };
    }

    public function getMatriculaInicial() {
        return $this->matricula_inicial;
    }

    public function getMatriculaPrimario() {
        return $this->matricula_primario;
    }

    public function getMatriculaMedio() {
        return $this->matricula_medio;
    }

    public function getMatriculaTerciario() {
        return $this->matricula_terciario;
    }

    public function setEstablecimientoEdificio(EstablecimientoEdificio $establecimiento_edificio) {
        $this->establecimiento_edificio = $establecimiento_edificio;
    }

    public function setMatriculaInicial($matricula) {
        $this->matricula_inicial = $matricula;
    }

    public function setMatriculaPrimario($matricula) {
        $this->matricula_primario = $matricula;
    }

    public function setMatriculaMedio($matricula) {
        $this->matricula_medio = $matricula;
    }

    public function setMatriculaTerciario($matricula) {
        $this->matricula_terciario = $matricula;
    }

}