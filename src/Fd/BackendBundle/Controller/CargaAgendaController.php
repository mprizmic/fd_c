<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\BackendBundle\Form\Filter\CargaAgendaPlantelFilterType;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitador;
use Fd\EstablecimientoBundle\Model\OrganizacionInternaManager;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Dependencia;

/**
 * @Route("/cargaagenda")
 */
class CargaAgendaController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * Muestra una damero de sedes y anexos para seleccionar uno y cargar la organizacion
     * 
     * @Route("/organizacion_damero", name="backend.cargaagenda.organizacion_damero")
     */
    public function OrganizacionDameroAction() {

        $sedes_anexos = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->findSedesYAnexosOrdenados();

        return $this->render('BackendBundle:CargaOrganizacion:damero.html.twig', array(
                    'sedes_anexos' => $sedes_anexos,
                        )
        );
    }

    /**
     * Dada una sede/anexo muestra la tabla de dependencias para asignar desasignar
     * 
     * @Route("/organizacion_asignar/{id}", name="backend.cargaagenda.organizacion_asignar")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id"="id"})
     */
    public function OrganizacionAsignarAction(EstablecimientoEdificio $establecimiento_edificio) {

        //creo el array de formularios para seleccionar dependencias
        $dependencias_forms = $this->getDependenciasForms($establecimiento_edificio);

        //muestra la pagina con todas las dependencias
        return $this->render('BackendBundle:CargaOrganizacion:asignar_dependencia.html.twig', array(
                    'dependencias_forms' => $dependencias_forms,
                    'sede_anexo' => $establecimiento_edificio,
                    'accion' => 'backend.cargaagenda.organizacion_do_asignar_dependencia',
        ));
    }

    /**
     * proceso la asignacion de la dependencia a la sede_anexo
     * 
     * @Route("/organizacion_asignar_do", name="backend.cargaagenda.organizacion_do_asignar_dependencia")
     */
    public function do_organizacion_asignarAction(Request $request) {

        $respuesta = new Respuesta();
        $tipo = 'error';

        $data = $request->request->all();
        // Recupero el array con los datos del form.
        //No puedo recuperar directamente con get('form') porque no se el nombre del form, que estàn numerados
        foreach ($data as $key => $value) {
            $form = $value;
        }

        $manager = new OrganizacionInternaManager($this->getEm());

        $existe = $this->getEm()->getRepository('EstablecimientoBundle:OrganizacionInterna')
                ->findOneBy(array(
            'establecimiento' => $form['establecimiento_edificio_id'],
            'dependencia' => $form['dependencia_id'],
        ));

        if ($existe) {
            if ($form['accion_del_form'] == 'Asignar') {

                //hay error en el datos que llega del form
                $tipo = 'error';
            } else {

                //se procede a desasignar
                $respuesta = $manager->eliminar($existe);
            };
        } else {

            if ($form['accion_del_form'] == 'Asignar') {

                //se procede a asignar
                $oi = $this->procesoForm($form, $manager);
                $respuesta = $manager->crear($oi);
            } else {
                //hay error en el procesamiento
                $tipo = 'error';
            };
        }


        $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';

        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('backend.cargaagenda.organizacion_asignar', array('id' => $form['establecimiento_edificio_id'])));
    }

    private function procesoForm($form, $manager) {

        $establecimiento = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->find($form['establecimiento_edificio_id']);

        if (!$establecimiento) {
            return null;
        }

        $dependencia = $this->getEm()
                ->getRepository('TablaBundle:Dependencia')
                ->find($form['dependencia_id']);

        if (!$dependencia) {
            return null;
        }

        $oi = $manager->crearNuevo($establecimiento, $dependencia);

        return $oi;
    }

    /**
     * genera el array de formularios para asignar los dependencias
     */
    private function getDependenciasForms($establecimiento_edificio) {

        $resultado = array();

        /**
         * obtengo la lista de dependencias.
         * 
         * Cada dependencia ya puede estar o no relacionada con la sede/anexo.
         * Si lo está va con un botón de desasignar, y viceversa
         * Si la relación ya tiene relación on plantel_establecimiento, no se puede desasignar 
         * hasta que se desasigne la relación con plantel_establecimeinto
         */
        $dependencias = $this->getEm()
                ->getRepository('TablaBundle:Dependencia')
                ->findAllOrdenado();

        //genero un array con los formuarios con la acción que les corresponda
        foreach ($dependencias as $key => $dependencia) {

            $resultado[] = array(
                'nombre' => $dependencia->getNombre(),
                'form' => $this->crearAsignarForm(
                        $dependencia, $establecimiento_edificio, $key
                )->createView(),
            );
        };

        return $resultado;
    }

    private function crearAsignarForm(Dependencia $dependencia, EstablecimientoEdificio $establecimiento_edificio, $nro_form) {

        //vertifica si en esa localizacion se está impartiendo la carrera
        $manager = $this->get('fd.establecimiento.organizacioninterna.manager');
        $existe = $manager->oi_existente($establecimiento_edificio, $dependencia);

        $data = array(
            'dependencia_id' => $dependencia->getId(),
            'establecimiento_edificio_id' => $establecimiento_edificio->getId(),
            'accion_del_form' => $existe ? 'Desasignar' : 'Asignar',
        );

        $form = $this->get('form.factory')
                ->createNamedBuilder('form' . $nro_form, 'form', $data)
                ->add('dependencia_id', 'hidden')
                ->add('establecimiento_edificio_id', 'hidden')
                ->add('accion_del_form', 'hidden')
                ->getForm();

        return $form;
    }

    /**
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     * *****************************************************************
     */

    /**
     * @Route("/plantel_buscar", name="backend.cargaagenda.plantel.buscar")
     */
    public function PlantelBuscarAction(Request $request) {

        //se diparó la búsqueda desde el formulario
        $search_form = $this->createForm(
                new CargaAgendaPlantelFilterType(
                $this->getCmbEstablecimientos(), $this->getCmbDependencia()
        ));

        return $this->render('BackendBundle:CargaPlantel:buscar.html.twig', array(
                    'search_form' => $search_form->createView(),
                        )
        );
    }

    public function getCmbEstablecimientos() {
        $resultado = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->acceptDatosAChoice(new DatosAChoiceVisitador());

        return $resultado;
    }

    public function getCmbDependencia() {
        return $this->getEm()
                        ->getRepository('TablaBundle:Dependencia')
                        ->acceptDatosAChoice(new DatosAChoiceVisitador());
    }

    /**
     * Dada una sede/anexo y una dependencia muestra la tabla de cargos para asignar/desasignar
     * Si el registro de plantel_establecimiento no exite vuelve a la busqueda
     * 
     * @Route("/plantel_asignar", name="backend.cargaagenda.plantel.asignar")
     */
    public function PlantelAsignarAction(Request $request) {
        
        

        $search_form = $request->get('cargaagendaplantel_filter');
        
        $establecimiento_edificio = $search_form['establecimiento'];

        $manager = $this->get('fd.backend.organizacion_interna.manager');

        if ($manager->oi_existente($establecimiento_edificio, $dependencia)) {
            
        } else {
            //no existe la selección realizada. Se vuelve a la busqueda
            $this->redirect($this->generateUrl('backend.cargaagenda.plantel.buscar'));
        }
        //creo el array de formularios para seleccionar dependencias
//        $dependencias_forms = $this->getDependenciasForms($establecimiento_edificio);
        //muestra la pagina con todas las dependencias
        return $this->render('BackendBundle:CargaOrganizacion:asignar_dependencia.html.twig', array(
                    'dependencias_forms' => $dependencias_forms,
                    'sede_anexo' => $establecimiento_edificio,
                    'accion' => 'backend.cargaagenda.organizacion_do_asignar_dependencia',
        ));
    }

}
