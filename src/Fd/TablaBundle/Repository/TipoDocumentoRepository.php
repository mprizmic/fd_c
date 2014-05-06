<?php

namespace Fd\TablaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\AlumnoBundle\lib\Respuesta;

/**
 * TipoDocumentoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TipoDocumentoRepository extends EntityRepository
{
    public function crear( $entity){
        $respuesta = new Respuesta();
        
        try{
            $em = $this->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó el tipo de documento exitosamente');            
            
        }catch (Exception $e){
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar el nuevo tipo de documento. Verifique los datos y reintente');
        }
        
        return $respuesta;
    }
    public function actualizar( $entity){
        return $this->crear($entity);
    }
    public function eliminar($id)
    {
        $respuesta = new Respuesta();
        
        $entity = $this->find($id);
        
        if (!$entity){
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se encontró el código que se desea eliminar');
            
        }  else {
            try{
                $em = $this->getEntityManager();
                $em->remove($entity);
                $em->flush();
                
                $respuesta->setCodigo(1);
                $respuesta->setMensaje('El tipo de documento fue eliminado exitosamente');
                
            } catch (\Exception $e){
                $respuesta->setCodigo(3);
                $respuesta->setMensaje('No se pudo eliminar el tipo de documento. Verifique los datos y reintente');
            }
        }            
        return $respuesta;
    }
    public function porOrden()
    {
        return $this->findTodosByOrdenar();
    }
    /**
     * query para el paginador de la accion index
     */
    public function queryTodosByOrdenar()
    {
        $consulta = $this->_em->createQuery('select t from TablaBundle:TipoDocumento t order by t.ordenar');

        return $consulta;
    }
    public function findTodosByOrdenar()
    {
        return $this->queryTodosByOrdenar()->getResult();
    }
    
}