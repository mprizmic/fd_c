<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;
use Fd\EstablecimientoBundle\Repository\PlantelEstablecimientoRepository;
use Fd\TablaBundle\Entity\Cargo;

class PlantelEstablecimientoManager {

    private $em;
    private $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $this->em->getRepository('EstablecimientoBundle:PlantelEstablecimiento');
    }

    public function getEm(){
        return $this->em;
    }
    /**
     * Crea un nuevo objeto vacío
     * 
     * @return PantelEstablecimiento
     */
    public static function crearVacio() {
        return new PlantelEstablecimiento();
    }

    /**
     * A partir de los 2 objetos parametro devuelve un objeto plantel_establecimiento previo chequeo de su existencia
     * Si existe devuelve el objeto existente, si no devuelve un objeto nuevo sin persistir
     * 
     * @param OrganizacionInterna $organizacion_interna
     * @param Cargo $cargo
     */
    public function crearLleno($organizacion_interna_id, $cargo_id){
        $pe = $this->existe($organizacion_interna_id, $cargo_id);
        
        if ($pe){
            return $pe;
        }
        
        $organizacion_interna = $this->getEm()
                ->getRepository('EstablecimientoBundle:OrganizacionInterna')
                ->find($organizacion_interna_id);

        if (!$organizacion_interna) {
            return null;
        }

        $cargo = $this->getEm()
                ->getRepository('TablaBundle:Cargo')
                ->find($cargo_id);

        if (!$cargo) {
            return null;
        }

        $pe = $this->crearVacio();
        $pe->setCargo($cargo);
        $pe->setOrganizacion($organizacion_interna);

        return $pe;
        
    }
    /**
     * @return type
     */
    public function persistir($plantel_establecimiento, $flush = true) {

        $respuesta = new Respuesta(2, 'No se pudo generar el cargo');


        // no se pone catch por que sólo genera un cartel que ya general por default Respuesta
        try {
            $this->em->persist($plantel_establecimiento);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('El cargo se actualizó correctamente');
            $respuesta->setObjNuevo($entity);
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al guardar');

        };
        return $respuesta;
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        try {

            $this->em->remove($entity);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la relación exitosamente.');
        } catch (Exception $e){
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar.');

        };
        return $respuesta;
    }
    /**
     * vertifica si existe la relacion organizacion - cargo
     * si existe devuelve el objeto. Si no existe devuelve null
     */
    public function existe($organizacion_interna, $cargo) {

        return $this->repository
                ->findOneBy(array(
                    'organizacion' => $organizacion_interna,
                    'cargo' => $cargo,
        ));
    }

}
