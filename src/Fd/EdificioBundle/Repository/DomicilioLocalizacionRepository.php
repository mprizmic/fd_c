<?php

namespace Fd\EdificioBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;

class DomicilioLocalizacionRepository extends EntityRepository {
    
    public function getBuilder() {
        return $this->createQueryBuilder('dl');
    }
    /**
     * devuelve el builder de la consulta de los domicilio_localizacion filtrados por el valor de algún campo.
     * Ejemplo de uso
     * $domicilio_localizaciones = $repositorio->getFilterBy(array('domicilio' => 22))->getQuery()->getResult();
     * 
     * @param type $campo
     * @return type
     */
    public function getFilterBy($campo) {
        $builder = $this->getBuilder();

        $this->filterBy($builder, $campo);
        return $builder;
    }
    public function filterBy(&$builder, $campo) {
        $clave = key($campo);
        $builder->where('dl.' . $clave . '= :' . $clave);
        $builder->setParameter($clave, $campo[$clave]);
        return $builder;
    }
    
    

    public function crear(Localizacion $localizacion, Domicilio $domicilio) {

        $respuesta = new Respuesta();
        $em = $this->_em;

        try {
            $dl = new DomicilioLocalizacion();
            $dl->setDomicilio($domicilio);
            $dl->setLocalizacion($localizacion);
            $em->persist($dl);
            $em->flush();

            $respuesta->setClaveNueva($dl->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la relación entre la localización y el domicilio exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la relación entre la localización y el domicilio. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    public function eliminar(DomicilioLocalizacion $entity) {
        $respuesta = new Respuesta();
        $em = $this->_em;
        try {
            $em->remove($entity);
            $em->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la relación entre la localización y los domicilios exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la relación entre la localización y los domicilios. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    /**
     * Verifica si en el grupo de domicilios de la localizacion que se esta pasando como parametro, 
     * existe otro principal o predeterminado, que sea distinto del que se esta pasando.
     * El parámetro es un domicilio_localizacion existente.
     * 
     * Devuelve un objeto tipo domicilio_localizacion que es el actual domicilio principal, distinto del parametro, o NULL
     * 
     * @param type $domicilio_localizacion
     */
    public function hasOtroDomicilioPredeterminado($domicilio_localizacion) {

        $builder = $this->getBuilder()
                ->where('dl.localizacion = :localizacion')
                ->andWhere('dl.principal = :predeterminado')
                ->andWhere('dl.id <> :clave');


        $builder->setParameter('clave', $domicilio_localizacion->getId());
        $builder->setParameter('predeterminado', TRUE);
        $builder->setParameter('localizacion', $domicilio_localizacion->getLocalizacion()->getId());

        try {
            $otro_principal = $builder->getQuery()->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $otro_principal = null;
        };
        return $otro_principal;
    }

    /**
     * Cambia el domicilio a predeterminado
     * 
     * @param type $domicilio_localizacion
     */
    public function establecerPredeterminado($domicilio_localizacion) {
        $valor = TRUE;
        $this->cambiarPredeterminado($domicilio_localizacion, $valor);
        return;
    }
    /**
     * Cambia el domicilio a no predeterminado
     * 
     * @param type $domicilio_localizacion
     * @return type
     */
    public function cancelarPredeterminado( $domicilio_localizacion ){
        $valor = FALSE;
        $this->cambiarPredeterminado($domicilio_localizacion, $valor);
        return;
    }
    /**
     * Cambia el estado del campo principal de la entidad pasada como parametro
     * 
     * @param type $entity
     * @param type $valor
     */
    private function cambiarPredeterminado($entity, $valor) {
        $entity->setPrincipal($valor);
        $this->_em->persist($entity);
        $this->_em->flush();
        return;
    }

}
