<?php

namespace Fd\EstablecimientoBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\TablaBundle\Entity\Nivel;

/**
 * ojeto del modelo
 * Sirve para cargar la cantidad de docentes de cada nivel de un establecimeito en particular
 */
class DocentesNivelClass {

    /**
     * @var integer $id
     *
     */
    private $id;
    private $establecimiento;

    /**
     * @Assert\Type("integer")
     */
    private $cantidad_inicial;

    /**
     * @Assert\Type("integer")
     */
    private $cantidad_primario;

    /**
     * @Assert\Type("integer")
     */
    private $cantidad_medio;

    /**
     * @Assert\Type("integer")
     */
    private $cantidad_terciario;

    public function __construct(Establecimiento $establecimiento) {

        $this->establecimiento = $establecimiento;
        $unidades_educativas = $establecimiento->getUnidadesEducativas();
        foreach ($unidades_educativas as $unidad_educativa) {
            $this->setCantidad( $unidad_educativa->getNivel()->getAbreviatura(), $unidad_educativa->getCantidadDocentes());
        }
    }

    public function getEstablecimiento() {
        return $this->establecimiento;
    }

    public function getCantidad($nivel) {
        if ($nivel == 'Ini') {
            return $this->getCantidadInicial();
        };
        if ($nivel == 'Pri') {
            return $this->getCantidadPrimario();
        };
        if ($nivel == 'Med') {
            return $this->getCantidadMedio();
        };
        if ($nivel == 'Ter') {
            return $this->getCantidadTerciario();
        };
    }
    public function setCantidad($nivel, $cantidad) {
        if ($nivel == 'Ini') {
            $this->setCantidadInicial($cantidad);
        };
        if ($nivel == 'Pri') {
            $this->setCantidadPrimario($cantidad);
        };
        if ($nivel == 'Med') {
            $this->setCantidadMedio($cantidad);
        };
        if ($nivel == 'Ter') {
            return $this->setCantidadTerciario($cantidad);
        };
    }

    public function getCantidadInicial() {
        return $this->cantidad_inicial;
    }

    public function getCantidadPrimario() {
        return $this->cantidad_primario;
    }

    public function getCantidadMedio() {
        return $this->cantidad_medio;
    }

    public function getCantidadTerciario() {
        return $this->cantidad_terciario;
    }

    public function setEstablecimiento($establecimiento) {
        $this->establecimiento = $establecimiento;
    }

    public function setCantidadInicial($cantidad) {
        $this->cantidad_inicial = $cantidad;
    }

    public function setCantidadPrimario($cantidad) {
        $this->cantidad_primario = $cantidad;
    }

    public function setCantidadMedio($cantidad) {
        $this->cantidad_medio = $cantidad;
    }

    public function setCantidadTerciario($cantidad) {
        $this->cantidad_terciario = $cantidad;
    }

}