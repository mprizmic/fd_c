<?php

namespace Fd\EdificioBundle\Repository;

use Doctrine\ORM\EntityRepository;
//use Fd\EdificioBundle\lib\Respuesta;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\EstablecimientoBundle\Entity\Respuesta;

class DomicilioRepository extends EntityRepository {

    /**
     * crea un nuevo registro DOMICILIO
     * Si es un domicilio de un edificio que no tiene domicilio principal establecido, se establece este
     * 
     * @param type $entity
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function crear($entity) {

        //verifica otro posible domicilio del edificio
        $respuesta = new Respuesta();
        $em = $this->_em;

        try {
            $em->persist($entity);
            $em->flush();

            //DEPRECATED
            $respuesta->setClaveNueva($entity->getId());
            
            //nuevo
            $respuesta->setObjNuevo($entity);

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó el nuevo domicilio exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar el nuevo domicilio. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    public function getBuilder() {
        return $this->createQueryBuilder('d');
    }

    public function filterBy(&$builder, $campo) {
        $clave = key($campo);
        $builder->where('d.' . $clave . '= :' . $clave);
        $builder->setParameter($clave, $campo[$clave]);
        return $builder;
    }

    /**
     * devuelve el builder de la consulta de los domicilios filtrados por el valor de algún campo.
     * Ejemplo de uso
     * $domicilios = $repositorio->getFilterBy(array('edificio' => 22))->getQuery()->getResult();
     * 
     * @param type $campo
     * @return type
     */
    public function getFilterBy($campo) {
        $builder = $this->getBuilder();

        $this->filterBy($builder, $campo);
        return $builder;
    }

    /**
     * actualiza un domicilio
     * debe verificar que no se esté duplicando el domicilio principal de un edificio
     * 
     * @param type $entity
     * @return \Fd\EdificioBundle\Repository\Respuesta
     */
    public function actualizar($entity_bindeada) {
        $em = $this->_em;

        $respuesta = new Respuesta();

        //busca otro registro de domicilio que sea del mismo edificio y que sea domicilio principal
        $domicilio_principal_anterior = $this->hasOtroDomicilioPrincipal($entity_bindeada);
        try {
            //si existía un domicilio principal distinto del actual y al actual domicilio se le pone como principal
            if ($domicilio_principal_anterior and $entity_bindeada->getPrincipal()) {
                //le saco la marca de principal al domicilio anterior
                $domicilio_principal_anterior->setPrincipal(FALSE);
                $em->persist($domicilio_principal_anterior);
            }

            //si el edificio no tiene otro domiciio principal, la entidad bindeada queda en TRUE
            if (!$domicilio_principal_anterior) {
                $entity_bindeada->setPrincipal(TRUE);
            }
            //guardo el nuevo domicilio principal
            $em->persist($entity_bindeada);
            $em->flush();
            $respuesta->setClaveNueva($entity_bindeada->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó el domicilio exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar el domicilio. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    /**
     * FALTA NO ANDA puede haber un domicilio sin edificioS
     * 
     * Verifica si el domicilio que se está pasando de parámetro pertenece a un 
     * edificio que ya tiene domicilio principal, distinto del parametro que se está pasando
     * 
     * Devuelve un objeto tipo domicilio que es el actual domcilio principal, o NULL
     * 
     * @param type $entidad_nueva
     */
    public function hasOtroDomicilioPrincipal($entity_nueva) {

        $builder = $this->getBuilder()
                ->where('d.edificio = :edificio')
                ->andWhere('d.principal = :principal');

        if ($entity_nueva->getId()) {
            $builder->andWhere('d.id <> :clave');
            $builder->setParameter('clave', $entity_nueva->getId());
        }

        $builder->setParameter('principal', TRUE);
        $builder->setParameter('edificio', $entity_nueva->getEdificio()->getId());

        try {
            $otro_principal = $builder->getQuery()->getsingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $otro_principal = null;
        };
        return $otro_principal;
    }

}
