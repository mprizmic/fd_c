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
}
