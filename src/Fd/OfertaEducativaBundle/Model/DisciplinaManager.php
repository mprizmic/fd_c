<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Disciplina;

class DisciplinaManager {

    protected $em;
    protected $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $this->em->getRepository('OfertaEducativaBundle:Disciplina');
    }

    /**
     * Crea un nuevo objeto vacío
     * 
     * @return Dependencia
     */
    public static function crearVacio() {
        return new Disciplina();
    }

    /**
     * Persiste un objeto y devuelve un objeto con el resultado
     * 
     * @return Respuesta
     */
    public function crear($entity, $flush = true) {

        $respuesta = new Respuesta();

        $em = $this->em;

        try {


            $em->persist($entity);

            if ($flush) {
                $em->flush();
            }

            $respuesta->setObjNuevo($entity);
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la disciplina exitosamente');
            
        } catch (\Exception $e) {

            $respuesta->setMensaje('No se pudo guardar la disciplina. Verifique los datos y reintente');

        };
        return $respuesta;
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        $em = $this->em;

        try {

            $em->remove($entity);

            if ($flush) {
                $em->flush();
            }

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la disciplina exitosamente');
        } catch (Exception $e) {
            $respuesta->setMensaje('No se pudo eliminar la disciplina');
        }
        return $respuesta;
    }

}
