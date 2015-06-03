<?php

namespace Fd\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\UsuarioBundle\Entity\Usuario;
use Fd\UsuarioBundle\Form\UsuarioType;
use Fd\UsuarioBundle\Form\UsuarioPasswordType;
use Fd\UsuarioBundle\Model\UsuarioManager;

class DefaultController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * 
     * @Template("UsuarioBundle:Default:index.html.twig")
     */
    public function indexAction() {
        $usuarios = $this->getEm()
                ->getRepository('UsuarioBundle:Usuario')
                ->findAll();
        return array('usuarios' => $usuarios);
    }

    /**
     * Displays a form to create a new usuario entity.
     * 
     * 
     * @Template("UsuarioBundle:Default:usuario.html.twig")
     */
    public function nuevoAction() {

        $entity = new Usuario();
        $form = $this->createForm(new UsuarioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'titulo' => 'Nuevo',
            'accion' => 'crear',
        );
    }

    /**
     * Creates a new usuario entity.
     *
     * @Method("post")
     */
    public function crearAction() {

        $entity = new Usuario();

        $request = $this->getRequest();

        $form = $this->createForm(new UsuarioType(), $entity);

        $respuesta = new Respuesta(2, 'Problemas en la creación del usuario'); //carga error por default

        $form->bind($request);

        if ($form->isValid()) {

            $usuario_valido = $form->getData();

            $encoder_factory = $this->get('security.encoder_factory');

            $usuario_manager = new UsuarioManager($this->getEm());

            $respuesta = $usuario_manager->crear($usuario_valido, $encoder_factory);
        } else {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('El formulario tiene problemas. Verifique y reintente');
        };

        $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';
        
        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {
            return $this->redirect($this->generateUrl('usuario_editar', array(
                                'id' => $respuesta->getClaveNueva(),
                            )))
            ;
        };

        return $this->render('UsuarioBundle:Default:usuario.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'titulo' => 'Nuevo',
                    'accion' => 'crear',
                ))
        ;
    }

    /**
     * Despliega una pagina con un registro preexistente
     * 
     * @ParamConverter("usuario", class="UsuarioBundle:Usuario")
     */
    public function editarAction($usuario) {

        //el registro existe. Creo el formulario para mostrarlo
        $form = $this->createForm(new UsuarioType(), $usuario);

        //creo el boton de eliminar, que es un formulario
        $deleteForm = $this->createDeleteForm($usuario->getId());

        //renderizo en la plantilla correpondiente
        $engine = $this->container->get('templating');
        $content = $engine->render('UsuarioBundle:Default:usuario.html.twig', array(
            'form' => $form->createView(),
            'titulo' => 'Editar',
            'entity' => $usuario,
            'accion' => 'actualizar',
            'delete_form' => $deleteForm->createView(),
                ));

        return new Response($content);
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * @ParamConverter("entity", class="UsuarioBundle:Usuario")
     */
    public function actualizarAction(Request $request, Usuario $entity) {

        $respuesta = new Respuesta();

        $passwordOriginal = $entity->getPassword();

        //formulario creado con el entity del repositorio
        $form = $this->createForm(new UsuarioType(), $entity);

        $form->bind($request);

        if ($form->isValid()) {

            if (null == $entity->getPassword()) {
                $entity->setPassword($passwordOriginal);
            }

            $usuario_manager = new UsuarioManager($this->getEm());

            $encoder_factory = $this->get('security.encoder_factory');

            $respuesta = $usuario_manager->actualizar($form->getData(), $encoder_factory);
        };
        
        $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';
        
        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {
            return $this->redirect($this->generateUrl('usuario_editar', array('id' => $entity->getId())));
        };

        $delete_form = $this->createDeleteForm($entity->getId());

        return $this->render('UsuarioBundle:Default:usuario.html.twig', array(
                    'form' => $form->createView(),
                    'titulo' => 'Editar',
                    'entity' => $entity,
                    'accion' => 'actualizar',
                    'delete_form' => $delete_form->createView(),
                ));
    }

    /**
     * @ParamConverter("usuario", class="UsuarioBundle:Usuario")
     * @Method("post")
     */
    public function eliminarAction(Usuario $usuario, Request $request) {

        $respuesta = new Respuesta();

        $form = $this->createDeleteForm($usuario->getId());

        $form->bind($request);

        if ($form->isValid()) {

            $usuario_manager = new UsuarioManager($this->getEm());

            $respuesta = $usuario_manager->eliminar($usuario, true);
        };

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('usuario_index'));
    }

    /**
     * Despliega una pagina para cambiar la password de un usuario existente
     * 
     * @ParamConverter("usuario", class="UsuarioBundle:Usuario")
     */
    public function cambio_passwordAction(Usuario $usuario) {

        //el registro existe. Creo el formulario para mostrarlo
        $form = $this->createForm(new UsuarioPasswordType(), $usuario);

        //renderizo en la plantilla correpondiente
        $engine = $this->container->get('templating');
        $content = $engine->render('UsuarioBundle:Default:usuario_cambio_password.html.twig', array(
            'form' => $form->createView(),
            'entity' => $usuario,
                ));

        return new Response($content);
    }

    /**
     * @ParamConverter("usuario", class="UsuarioBundle:Usuario")
     */
    public function cambiar_passwordAction(Request $request, Usuario $usuario) {

        $respuesta = new Respuesta();

        //formulario creado con el entity del repositorio
        $form = $this->createForm(new UsuarioPasswordType(), $usuario);

        $form->bind($request);

        if ($form->isValid()) {

            $usuario_manager = new UsuarioManager($this->getEm());

            $encoder_factory = $this->get('security.encoder_factory');

            $respuesta = $usuario_manager->cambiar_password($form->getData(), $encoder_factory);
        };

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {
            return $this->redirect($this->generateUrl('usuario_editar', array('id' => $usuario->getId())));
        };

        return $this->render('UsuarioBundle:Default:usuario_cambio_password.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $usuario,
                ))
        ;
    }

    /**
     * FALTA no estaría en uso. Hay que chequear
     * 
     * @return type 
     */
    public function loginAction() {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR, $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        return $this->render('UsuarioBundle:Default:login.html.twig', array(
                    'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
                    'error' => $error
                ));
    }

}