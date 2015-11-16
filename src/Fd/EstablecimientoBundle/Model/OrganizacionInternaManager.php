<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Repository\OrganizacionInternaRepository;
use Fd\TablaBundle\Entity\Dependencia;

class OrganizacionInternaManager {

    private $em;
    private $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $this->em->getRepository('EstablecimientoBundle:OrganizacionInterna');
    }

    /**
     * Crea un nuevo objeto vacío
     * 
     * @return OrganizacionInterna
     */
    public static function crearVacio() {
        return new OrganizacionInterna();
    }
    /**
     * Se genera un objeto nuevo en memoria
     * 
     * @param type $establecimiento
     * @param type $dependencia
     * @return type
     */
    public function crearNuevo($establecimiento, $dependencia){
        $oi = $this->crearVacio();
        
        $oi->setEstablecimiento($establecimiento);
        $oi->setDependencia($dependencia);
        
        return $oi;
    }

    /**
     * @return type
     */
    public function crear($organizacion_interna, $flush = true) {

        $respuesta = new Respuesta(2, 'No se pudo guardar la informacion');


        // no se pone catch por que sólo genera un cartel que ya general por default Respuesta
        try {
            $this->em->persist($organizacion_interna);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('La dependencia se actualizó correctamente');
            $respuesta->setObjNuevo($organizacion_interna);
        } finally {

            return $respuesta;
        }
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        try {

            $this->em->remove($entity);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la dependencia exitosamente.');
        } finally {

            return $respuesta;
        }
    }

    /**
     * vertifica si existe la relacion establecimeinto - dependencia 
     * si existe devuelve el objeto. Si no existe devuelve null
     */
    public function oi_existente(EstablecimientoEdificio $establecimiento_edificio, Dependencia $dependencia){
        
        return $this->repository()->findOneBy(array(
            'establecimiento' => $establecimiento_edificio,
            'dependencia' => $dependencia,
        ));
        
    }
}
