<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; //permite la annotation method
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\OfertaEducativaBundle\Repository\EspecializacionRepository;
use Fd\OfertaEducativaBundle\Entity\Especializacion;
use Fd\OfertaEducativaBundle\Form\EstablecimientosType;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\BackendBundle\Form\EspecializacionType;

/**
 * @Route("/especializacion")
 */
class EspecializacionController extends Controller {

    private $em;

    /**
     * @Route("/actualizar/{id}", name="especializacion_actualizar")
     */
    public function actualizarAction($id) {
        $respuesta = new Respuesta();

        $repo = $this->getEm()->getRepository('OfertaEducativaBundle:Especializacion');

        $entity = $repo->find($id);

        if (!$entity) {
            $respuesta->setMensaje('No se encontró la especialización');
        }

        //formulario creado con el entity del repositorio
        $formulario = $this->createForm(new EspecializacionType(), $entity);
        $delete_form = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $formulario->bind($request);

        if ($formulario->isValid()) {
            $respuesta = $repo->actualizar($entity);   //persiste la entity y no el request
            $tipo_flash = "notice";
        } else {
            $respuesta->setMensaje('La información cargada es incorrecta. Verifique y reintente');
            $tipo_flash = "error";
        }

        $session = $this->get('session');

        $session->setFlash($tipo_flash, $respuesta->getMensaje());

        return $this->render('OfertaEducativaBundle:Especializacion:especializacion.html.twig', array(
                    'formulario' => $formulario->createView(),
                    'titulo' => 'Editar',
                    'entity' => $entity,
                    'accion' => 'actualizar',
                    'delete_form' => $delete_form->createView(),
                ));
    }

    /**
     * @Route("/asignar_establecimiento/{id}", name="especializacion_asignar_establecimiento")
     */
    public function asignar_establecimientoAction(Request $request, $id) {
        $especializacion = $this->getEm()->getRepository('OfertaEducativaBundle:Especializacion')->find($id);

        if ($request->getMethod() == 'POST') {
            //proceso la asignacion de establecimiento a la especializacion
            $form = $this->getForm($especializacion);
            $form->bind($request);

            $respuesta = $this->getEm()
                    ->getRepository('OfertaEducativaBundle:Especializacion')
                    ->asignarEstablecimientos($especializacion, $form->getData());

            $session = $this->get('session');
            $session->setFlash('notice', $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('especializacion_ficha', array('especializacion_id' => $id)));
        }
        if ($request->getMethod() == 'GET') {
            //creo el formulario para seleccionar establecimientos

            $form = $this->getForm($especializacion);
            //crear el formulario de asignacion
            return $this->render('OfertaEducativaBundle:Default:asignar_establecimiento.html.twig', array(
                        'form' => $form->createView(),
                        'id' => $id,
                        'accion' => 'especializacion_asignar_establecimiento',
                        'titulo' => 'especialización',
                    ));
        }
    }

    /**
     * @Route("/crear", name="especializacion_crear")
     * @Method("post") //va con un USE arriba
     */
    public function crearAction() {
        $entity = new Especializacion();
        $request = $this->getRequest();
        $formulario = $this->createForm(new EspecializacionType(), $entity);

        $formulario->bind($request);

        $respuesta = new Respuesta();

        if ($formulario->isValid()) {
            $respuesta = $this->getEm()
                    ->getRepository('OfertaEducativaBundle:Especializacion')
                    ->crear($entity);
        } else {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('El formulario contiene errores. Verifique y vuelva a intentar');
        }

        if ($respuesta->getCodigo() == 1) {
            $accion = 'actualizar';

            $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('especializacion_editar', array(
                                'id' => $respuesta->getClaveNueva(),
                            )));
        } else {
            $accion = 'crear';

            $this->get('session')->getFlashBag()->add('error', $respuesta->getMensaje());

            return $this->render('OfertaEducativaBundle:Especializacion:especializacion.html.twig', array(
                        'formulario' => $formulario->createView(),
                        'titulo' => 'Crear nueva',
                        'entity' => $entity,
                        'accion' => $accion,
                    ));
        };
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm();
    }

    /**
     * @Route("/donde_se_dicta/{especializacion_id}", name="especializacion_donde_se_dicta")
     */
    public function donde_se_dictaAction($especializacion_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $especializacion = $em->getRepository('OfertaEducativaBundle:Especializacion')->find($especializacion_id);
        $establecimientos = $em->getRepository('EstablecimientoBundle:Establecimiento')->findEstablecimientosPorEspecializacion($especializacion);
        return $this->render('OfertaEducativaBundle:Carrera:includes/donde_se_dicta.html.twig', array(
                    'establecimientos' => $establecimientos,
                ));
    }

    /**
     * Despliega una pagina con un registro preexistente
     * @Route("/editar/{id}", name="especializacion_editar")
     */
    public function editarAction($id) {
        $entity = $this->getEm()->getRepository('OfertaEducativaBundle:Especializacion')
                ->find($id);

        if (!$entity) {
            $this->get('session')->getFlashbag()->add('error', 'No existe la especialización');
            return new RedirectResponse($this->generateUrl('especializacion_nomina'));
        }

        //el registro existe. Creo el formulario para mostrarlo
        $formulario = $this->createForm(new EspecializacionType(), $entity);
        //creo el boton de eliminar, que es un formulario
        $deleteForm = $this->createDeleteForm($id);

        //renderizo en la plantilla correpondiente
        return $this->render('OfertaEducativaBundle:Especializacion:especializacion.html.twig', array(
                    'formulario' => $formulario->createView(),
                    'titulo' => 'Editar',
                    'entity' => $entity,
                    'accion' => 'actualizar',
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * @Route("/eliminar/{id}", name="especializacion_eliminar")
     */
    public function eliminarAction($id) {
        //busco 
        $respuesta = $this->getEm()->getRepository('OfertaEducativaBundle:Especializacion')
                ->eliminar($id);

        if ($respuesta->getCodigo() == 1) {
            $this->get('session')->getFlashbag()->add('notice', $respuesta->getMensaje());
            return $this->redirect($this->generateUrl('especializacion_nomina'));
        };
        $this->get('session')->getFlashbag()->add('error', $respuesta->getMensaje());
        return $this->redirect($this->generateUrl('especializacion_editar', array('id' => $id)));
    }

    /**
     * @Route("/ficha/{especializacion_id}", name="especializacion_ficha")
     */
    public function fichaAction($especializacion_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $especializacion = $em->getRepository('OfertaEducativaBundle:Especializacion')->find($especializacion_id);
        return $this->render('OfertaEducativaBundle:Especializacion:ficha.html.twig', array(
                    'especializacion' => $especializacion,
                ));
    }

    private function formatearDatosParaAsignar($establecimientos, $especializacion) {
        //los establecimientos que tienen la especializacion asignada y tiene cohortes deberían aparecer con el tilde y disable
        //primero armo la lista de todos los establecimientos
        //luego recupero los establecimientos que tienen la especializacion asignada 
        //despues recorro el vector y marco los que ya tienen la especializacion
        $resultado = array();
        foreach ($establecimientos as $key => $value) {
            $resultado[$key]['flag'] = false; //ver si esta asignado y si teiene cohortes
            $resultado[$key]['nombre'] = $value->getNombre();
            $resultado[$key]['id'] = $value->getId();
        };
        $asignados = $this->getEm()->getRepository('EstablecimientoBundle:Establecimiento')->findEstablecimientosPorEspecializacion($especializacion);
        if ($asignados) {
            foreach ($resultado as $key => $value) {
                foreach ($asignados as $asignado) {
                    if ($asignado->getId() == $resultado[$key]['id']) {
                        $resultado[$key]['flag'] = true;
                        break;
                    }
                }
            }
        }
        return $resultado;
    }

    /**
     * Devuelve la instancia del EntityManager. Si no existe la crea.
     * 
     * @return type
     */
    public function getEm() {
        if (is_null($this->em)) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }
    public function getRepo(){
        return $this->getEm()->getRepository('OfertaEducativaBundle:Especializacion');
    }

    private function getForm($especializacion) {
        $establecimientos_bd = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->findAllOrdenado('orden');

        $establecimientos = $this->formatearDatosParaAsignar($establecimientos_bd, $especializacion);

        $form = $this->createForm(new EstablecimientosType());

        $form->setData(array('establecimientos' => $establecimientos));

        return $form;
    }

    /**
     * @Route("/nomina", name="especializacion_nomina")
     */
    public function nominaAction() {

        $especializaciones = $this->getDoctrine()->getEntityManager()->getRepository('OfertaEducativaBundle:Especializacion')
                ->qyAllOrdenado('nombre')
                ->getResult();

        return $this->render('OfertaEducativaBundle:Especializacion:nomina.html.twig', array(
                    'especializaciones' => $especializaciones,
                ));
    }

    /**
     * @Route("/nomina_excel", name="especializacion_nomina_excel")
     */
    public function nominaExcelAction() {
        $filename = "Especializaciones.xls";
        // ask the service for a Excel5
        $excelService = $this->get('xls.service_xls5');

        $active_sheet_index = $excelService->excelObj->setActiveSheetIndex(0);

        $especializaciones = $this->getDoctrine()->getEntityManager()->getRepository('OfertaEducativaBundle:Especializacion')
                ->qyAllOrdenado('nombre')
                ->getResult();
        $fila = 3;

        $active_sheet_index->setCellValue('A1', 'Listado de especializaciones activas');

        foreach ($especializaciones as $especializacion) {
            $active_sheet_index->setCellValue('A' . $fila, $especializacion->getNombre());
            $fila += 1;
        }
        $excelService->excelObj->getActiveSheet()->setTitle('Especializaciones activas');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);

        //create the response
        $response = $excelService->getResponse();
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . $filename);

        // If you are using a https connection, you have to set those two headers for compatibility with IE <9
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        return $response;
    }
    /**
     * @Route("/vencimiento_excel", name="especializacion_vencimiento_excel")
     */
    public function vencimientoExcelAction() {
        $filename = "Especializaciones.xls";
        // ask the service for a Excel5
        $excelService = $this->get('xls.service_xls5');

        $active_sheet_index = $excelService->excelObj->setActiveSheetIndex(0);

        $especializaciones = $this->getRepo()
                ->findVencimiento()
                ;

        $active_sheet_index->setCellValue('A1', 'Listado de vencimiento de la validez de especializaciones activas');

        $active_sheet_index->setCellValue('b3', 'Nombre');
        $active_sheet_index->setCellValue('c3', 'Año de última cohorte valida');
        
        $fila = 4;
        
        foreach ($especializaciones as $especializacion) {
            $active_sheet_index->setCellValue('a' . $fila, $fila-3);
            $active_sheet_index->setCellValue('b' . $fila, $especializacion['nombre']);
            $active_sheet_index->setCellValue('c' . $fila, $especializacion['ultima_cohorte_valida']);
            $fila += 1;
        }
        $excelService->excelObj->getActiveSheet()->setTitle('Especializaciones activas');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);

        //create the response
        $response = $excelService->getResponse();
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . $filename);

        // If you are using a https connection, you have to set those two headers for compatibility with IE <9
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        return $response;
    }

    /**
     * Despliega la pagina para dar de alta un registro nuevo
     * 
     * @Route("/nuevo", name="especializacion_nuevo")
     */
    public function nuevoAction() {
        $entity = new Especializacion();
        $formulario = $this->createForm(new EspecializacionType(), $entity);

        return $this->render('OfertaEducativaBundle:Especializacion:especializacion.html.twig', array(
                    'formulario' => $formulario->createView(),
                    'titulo' => 'Nueva',
                    'entity' => $entity,
                    'accion' => 'crear',
                    ''));
    }

    /**
     * @Route("/vencimiento", name="especializacion_vencimiento")
     */
    public function vencimientoAction() {
        $campo = 'e.ultima_cohorte_valida';

        $especializaciones = $this->getRepo()
                ->findVencimiento()
                ;
        $especializaciones_sin_vencimiento = $this->getRepo()
                ->findSinVencimiento()
                ;
        
        return $this->render('OfertaEducativaBundle:Especializacion:vencimiento.html.twig', array(
                    'especializaciones' => $especializaciones,
                    'especializaciones_sin_vencimiento' => $especializaciones_sin_vencimiento,
                ));
    }

}