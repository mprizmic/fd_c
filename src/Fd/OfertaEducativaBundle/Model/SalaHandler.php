<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Entity\Sala;
use Fd\TablaBundle\Entity\GrupoEtario;
use Fd\TablaBundle\Repository\GrupoEtarioRepository;

class SalaHandler {

    protected $em;

    public function __construct(EntityManager $em = null) {
        if ($em) {
            $this->em = $em;
        };
    }

    public function crearDummy(InicialX $inicial_x, $q_secciones = null, GrupoEtario $grupo_etario = null, $flush = false) {
        $sala = new Sala();
        $sala->setInicialX($inicial_x);

        if ($q_secciones) {
            $sala->setQSecciones(1);
        };
        if (!$grupo_etario) {
            $grupo_etario = $this->em->getRepository('TablaBundle:GrupoEtario')->getDummy();
        };
        $sala->setGrupoEtario($grupo_etario);

        $this->em->persist($sala);

        if ($flush) {
            $this->em->flush();
        };

        return $sala;
    }

}
