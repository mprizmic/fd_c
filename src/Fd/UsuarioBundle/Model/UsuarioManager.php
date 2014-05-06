<?php

namespace Fd\UsuarioBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Fd\UsuarioBundle\Entity\Usuario;
use Fd\EstablecimientoBundle\Entity\Respuesta;

class UsuarioManager {

    protected $em;
    protected $respuesta;
    protected $encoder;

    public function __construct(EntityManager $em) {

        $this->em = $em;
        $this->respuesta = new Respuesta();
    }

    /**
     * @return type
     */
    public function crear(Usuario $usuario, $encoder_factory) {

        try {
            $encoder = $encoder_factory->getEncoder($usuario);

            $usuario->setSalt(md5(time()));

            $passwordCodificado = $encoder->encodePassword(
                    $usuario->getPassword(), $usuario->getSalt()
            );

            $usuario->setPassword($passwordCodificado);

            $this->em->persist($usuario);
            $this->em->flush();

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('El usuario se creó correctamente');
            $this->respuesta->setClaveNueva($usuario->getId());
        } catch (Exception $e) {

            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas en la creación del usuario');

            return $this->respuesta;
        };

        return $this->respuesta;
    }

    /**
     * No actualiza nunca la password
     * 
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar(Usuario $entity, $encoder_factory) {

        $respuesta = new Respuesta();

        try {
            //recupero las orientaciones que estàn originalmente guardadas en la BD

            $this->em->persist($entity);

            $this->em->flush();

            $respuesta->setClaveNueva($entity->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó el usuario exitosamente');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar el usuario. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    /**
     * @param type $flush
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function eliminar(Usuario $usuario, $flush = false) {
        $respuesta = new Respuesta();
        try {
            //el registro de oferta_norma se elimina sola
            $this->em->remove($usuario);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó el usuario exitosamente.');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $respuesta;
    }
    /**
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function cambiar_password(Usuario $usuario, $encoder_factory) {

        $respuesta = new Respuesta();

        try {
            $encoder = $encoder_factory->getEncoder($usuario);

            $usuario->setSalt(md5(time()));

            $passwordCodificado = $encoder->encodePassword(
                    $usuario->getPassword(), $usuario->getSalt()
            );

            $usuario->setPassword($passwordCodificado);

            $this->em->persist($usuario);

            $this->em->flush();

            $respuesta->setClaveNueva($usuario->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se cambió la password exitosamente');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la password. Verifique los datos y reintente');
        }

        return $respuesta;
    }
}