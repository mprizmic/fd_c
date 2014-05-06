<?php

namespace Fd\TablaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\TipoInstancia;

//use Fd\TablaBundle\Entity\Norma;

/**
 * @Route("/tabla")
 */
class DefaultController extends Controller {

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name) {
        return array('name' => $name);
    }

    /**
     * @Route("/prueba", name="prueba")
     */
    public function pruebaAction(Request $request) {
        if ($request->getMethod() == 'POST') {
            $datos = $request->request->all();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $form = $this->createFormBuilder()
                ->add('c1', 'checkbox', array('mapped' => false, 'required'=>false, 'label'=>'acabramos'))
                ->add('c2', 'text', array('mapped' => false, 'required'=>false, 'label'=>'nombre de la carrera', 'read_only'=>true))
                ->getForm();
        $form->getData();
        return $this->render("TablaBundle:Default:prueba.html.twig", array(
                    'form' => $form->createView(),
                ));
    }
    /**
     * @Route("/prueba2", name="prueba2")
     */
    public function prueba2Action() {
        $em = $this->getDoctrine()->getEntityManager();
//        $c = $em->getRepository('OfertaEducativaBundle:Carrera')->find(72);
        $o = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find(79);
//        $c->removeElement($no);
//        $oe->getNormas()->add($no);
        $em->remove($o);
//        $em->persist($no);
        $em->flush();
        return $this->render("TablaBundle:Default:prueba.html.twig");
    }

    /**
     * @Route("/prueba_json", name="prueba_json")
     */
    public function prueba_jsonAction() {
//        $respuesta = $this->getDoctrine()->getEntityManager()->getRepository('OfertaEducativaBundle:Norma')->findAllOrdenadoArray();
        $respuesta = '05';
        $datos = array("responseCode" => 200, "respuesta" => $respuesta);

        $response = new Response(json_encode($datos));

        $response->headers->set('content-type', 'application/json');

        return $response;
    }

    /**
     * @Route("/prueba_yepsua", name="prueba_yepsua")
     */
    public function prueba_yepsuaAction() {
        return $this->render('TablaBundle:Default:prueba_yepsua.html.twig');
    }

}
