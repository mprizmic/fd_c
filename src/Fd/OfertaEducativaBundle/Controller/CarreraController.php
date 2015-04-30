<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; //permite la annotation method
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\Norma;
use Fd\OfertaEducativaBundle\Form\CarreraType;
use Fd\OfertaEducativaBundle\Form\EstablecimientosType;
use Fd\OfertaEducativaBundle\Form\Handler\CarreraFormHandler;
use Fd\OfertaEducativaBundle\Form\Filter\CarreraFilterType;
use Fd\OfertaEducativaBundle\Model\CarreraManager;
use Fd\OfertaEducativaBundle\Repository\CarreraRepository;
use Fd\OfertaEducativaBundle\Repository\CarreraEstadoValidezRepository;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Repository\UnidadOfertaRepository;

/**
 * @Route("/carrera")
 */
class CarreraController extends Controller {

    private $em;

    public function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepo() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:Carrera');
    }

    /**
     * Busqueda de carrera.
     * 
     * @Route("/buscar", name="carrera_buscar")
     * @ParamConverter()
     */
    public function buscarAction(Request $request) {

        $session = $this->get('session');

        if ($request->getMethod() == 'POST') {

            //se diparó la búsqueda desde el formulario
            $form = $this->crearFormBusqueda();

            // bind values from the request
            $form->bind($request);

            if ($form->isValid()) {

                //se guardan los datos en la sesiòn
                $datos = $form->getData();
                $session->set('datos', $datos);

                //se generan los resultados a partir de los parametros cargados en el form de busqueda
                $carreras = $this->generarDatosBusquedaPaginada($form);
            };
        };

        if ($request->getMethod() == 'GET') {

            //o bien se pidió la página o bien se pidió la paginación de los resultados
            //la paginacion manda un GET con la variable 'page'. Si no existe 'page' no fue un request de paginacion
            if ($request->query->get('page')) {
                //se pidió paginación
                //regenero el form para mostrarlo con los datos que le habìa cargado
                $datos = $session->get('datos');
                $form = $this->crearFormBusqueda($datos);

                //hay por lo menos un campo con algo
                $carreras = $this->generarDatosBusquedaPaginada($form);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $form = $this->crearFormBusqueda();

                $carreras = null;
            }
        };

        return $this->render('OfertaEducativaBundle:Carrera:buscar.html.twig', array(
                    'carreras' => $carreras,
                    'form' => $form->createView(),
                        )
        );
    }

    /**
     * Genera un array que contiene los datos a ser mostrados en el template
     * Los genera a partir de los datos cargados en el form de busqueda usando el generador de filtro
     * y el paginador
     * 
     * @param type form
     * @return type array
     */
    public function generarDatosBusquedaPaginada($form) {
        //se crear la consulta
        $filterBuilder = $this->getRepo()->qbAllOrdenado('nombre');
        
        // build the query from the given form object
        $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

        //crea el paginador
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        //hay por lo menos un campo con algo
        $carreras = $paginador->paginate($filterBuilder->getQuery())
                ->getResult();

        return $carreras;
    }

    /**
     * Crea el formulario de busqueda de carrera.
     * Cuando se redespliega luego de avanzar una pàgina, se le recargan los datos originales que se guardaron 
     * previamente en la sesion.
     * 
     * @param type $datos_sesion
     * @return type 
     */
    public function crearFormBusqueda($datos_sesion = null) {

        $form = $this->createForm(new CarreraFilterType($this->getComboEstados(), $this->getComboFormaciones()));

        if ($datos_sesion)
            $form->setData($datos_sesion);

        return $form;
    }

    /**
     * Genera el array para popular el combo de estados de la carrera que aparece en el form de busqueda
     * 
     * @return type array
     */
    public function getComboEstados() {

        $manager = $this->get('ofertaeducativa.carrera.manager');

        return $manager->getComboEstados();
    }

    /**
     * Genera el array para popular el combo de tipos de formacion de la carrera que aparece en el form de busqueda
     * 
     * @return type array
     */
    public function getComboFormaciones() {

        $datos = $this->getEm()->
                getRepository('TablaBundle:TipoFormacion')->
                createQueryBuilder('t')->
                getQuery()->
                getArrayResult();

        foreach ($datos as $key => $value) {
            $tipos[$value['id']] = $value['descripcion'];
        }
        return $tipos;
    }

    /**
     * obtiene las carreras filtradas con la paginacion
     * @param type $datos
     * @return type
     */
    public function obtenerCarrerasPaginadas($datos) {
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        //hay por lo menos un campo con algo
        $carreras = $paginador->paginate(
                        $this->getRepo()->qyFiltradas($datos)
                )->getResult();
        return $carreras;
    }

    /**
     * Despliega la pagina para dar de alta un registro nuevo
     * 
     * @Route("/nuevo", name="carrera_nuevo")
     */
    public function nuevoAction() {
        $entity = new Carrera();
        $formulario = $this->get('form.factory')->create(new CarreraType(), $entity);

        $engine = $this->get('templating');

        $content = $engine->render('OfertaEducativaBundle:Carrera:carrera.html.twig', array(
            'formulario' => $formulario->createView(),
            'titulo' => 'Nueva',
            'entity' => $entity,
            'accion' => 'crear',
        ));

        return new Response($content);
    }

    /**
     * @Route("/crear", name="carrera_crear")
     * @Method("post") //va con un USE arriba
     * @ParamConverter()
     */
    public function crearAction(Request $request) {
        $entity = new Carrera();

        $form = $this->createForm(new CarreraType(), $entity);

        $formHandler = new CarreraFormHandler(new CarreraManager($this->getEm()));

        $respuesta = $formHandler->crear($form, $request);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {
            //ver si esto muestr el registro con la clave nueva o hay que sacarlo de $respuesta->getClaveNueva()
            return $this->redirect($this->generateUrl('carrera_editar', array('id' => $entity->getId())));
        };

        return $this->render('OfertaEducativaBundle:Carrera:carrera.html.twig', array(
                    'entity' => $entity,
                    'formulario' => $form->createView(),
                    'titulo' => 'Nueva',
                    'accion' => 'crear',
        ));
    }

    /**
     * @Route("/eliminar/{id}", name="carrera_eliminar")
     * @ParamConverter("carrera_anterior", class="OfertaEducativaBundle:Carrera")
     * @Method("post")
     */
    public function eliminarAction(Carrera $carrera_anterior, Request $request) {

        $respuesta = new Respuesta();

        $form = $this->createDeleteForm($carrera_anterior->getId());

        $formHandler = new CarreraFormHandler(new CarreraManager($this->getEm()));

        $respuesta = $formHandler->eliminar($form, $request, $carrera_anterior);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('carrera_nomina'));
    }

    /**
     * Despliega una pagina con un registro preexistente
     * 
     * @Route("/editar/{id}", name="carrera_editar")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Carrera")
     */
    public function editarAction($entity) {

        //el registro existe. Creo el formulario para mostrarlo
        $formulario = $this->createForm(new CarreraType(), $entity);

        //creo el boton de eliminar, que es un formulario
        $deleteForm = $this->createDeleteForm($entity->getId());

        //renderizo en la plantilla correpondiente
        $engine = $this->container->get('templating');
        $content = $engine->render('OfertaEducativaBundle:Carrera:carrera.html.twig', array(
            'formulario' => $formulario->createView(),
            'titulo' => 'Editar',
            'entity' => $entity,
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
     * FALTA testear
     * 
     * Lista de carreras para un combo formateados en json
     * Se puede filtrar por establecimiento_edificio
     * 
     * @Route("/combo/{establecimiento_id}", name="carrera_combo")
     * @ParamConverter("localizacion_terciario", class="EstablecimientoBundle:Localizacion", options={"id":"establecimiento_id"})
     */
    public function comboAction(Localizacion $localizacion_terciario = null) {

//        $establecimiento = $this->getEm()->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);

        $entities = $this->getEm()->getRepository('OfertaEducativaBundle:Carrera')->combo($localizacion_terciario);

        $carrera_manager = new CarreraManager($this->getEm());

        $carreras = $carrera_manager->generar_combo_json($entities);

        $response = new Response();
        $response->setContent(json_encode($carreras));

        return $response;
    }

    /**
     * @Route("/actualizar/{id}", name="carrera_actualizar")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Carrera")
     */
    public function actualizarAction(Request $request, Carrera $entity) {
        $respuesta = new Respuesta();

        //formulario creado con el entity del repositorio
        $formulario = $this->createForm(new CarreraType(), $entity);

        $form_handler = new CarreraFormHandler(new CarreraManager($this->getEm()));

        $respuesta = $form_handler->actualizar($formulario, $request);

        $flash_bag = $this->get('session')->getFlashBag();

        if ($respuesta->getCodigo() == 1) {
            $flash_bag->add('exito', $respuesta->getMensaje());
            return $this->redirect($this->generateUrl('carrera_editar', array('id' => $entity->getId())));
        };
        $flash_bag->add('error', $respuesta->getMensaje());

        $delete_form = $this->createDeleteForm($entity->getId());

        return $this->render('OfertaEducativaBundle:Carrera:carrera.html.twig', array(
                    'formulario' => $formulario->createView(),
                    'titulo' => 'Editar',
                    'entity' => $entity,
                    'accion' => 'actualizar',
                    'delete_form' => $delete_form->createView(),
        ));
    }

    /**
     * 
     * @Route("/ficha/{carrera_id}", name="carrera_ficha")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={"id":"carrera_id"} )
     */
    public function fichaAction($carrera) {
        $request = $this->getRequest();

        // establezco la ruta para la pagina que tenga que volver aca
        $this->get('session')->set('ruta_completa', $request->get('_route'));
        $this->get('session')->set('parametros', $request->get('_route_params'));


        //establecimientos en los que se dicta la carrera, según sede y anexo
        $localizaciones_temporario = $this->getRepo()->findLocalizaciones($carrera);

        foreach ($localizaciones_temporario as $key => $localizacion) {
            $unidad_oferta = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')->find($localizacion['unidad_oferta_id']);
            $turnos = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')->findTurnosArray($unidad_oferta);
            $localizacion['turnos'] = $turnos;

            $localizaciones[] = $localizacion;
            $x = true;
        }

        /**
         * estructura del array que se pasa a la plantilla
         * 
         * localizaciones[][localizacion_id]
         * localizaciones[][establecimiento_id]
         * localizaciones[][establecimiento_nombre]
         * localizaciones[][localizacion_nombre]
         * localizaciones[][cue_anexo]
         * localizaciones[][unidad_oferta_id]
         * localizaciones[][turnos]
         */
        return $this->render('OfertaEducativaBundle:Carrera:ficha.html.twig', array(
                    'carrera' => $carrera,
                    'localizaciones' => $localizaciones,
        ));
    }

    /**
     * proceso la asignacion de establecimientos a la carrera
     * 
     * @Route("/asignar_establecimiento/do", name="carrera_do_asignar_establecimiento")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $accion
     */
    public function do_asignarAction(Request $request) {
        if ($request->getMethod() == 'POST') {

            $data = $request->request->all();
            // Recupero el array con los datos del form.
            //No puedo recuperar directamente con get('form') porque no se el nombre del form, que estàn numerados
            foreach ($data as $key => $value) {
                $form = $value;
            }

            $manager = new CarreraManager($this->getEm());

            $respuesta = $manager->asignarEstablecimiento($form['carrera_id'], $form['localizacion_id'], $form['accion_del_form']);

            //se trata el response segùn el resutado
            $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('carrera_asignar_establecimiento', array('id' => $form['carrera_id'])));
        }
    }

    /**
     * @Route("/asignar_establecimiento/{id}", name="carrera_asignar_establecimiento")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera")
     */
    public function asignar_establecimientoAction(Carrera $carrera, Request $request) {

        if ($request->getMethod() == 'GET') {

            //creo el array de formularios para seleccionar establecimientos localizados
            $establecimientos_forms = $this->getEstablecimientosForms($carrera);

            //muestra la pagina para elegir en que localizacion se dicta la carrera
            return $this->render('OfertaEducativaBundle:Default:asignar_establecimiento.html.twig', array(
                        'establecimientos_forms' => $establecimientos_forms,
                        'carrera' => $carrera,
                        'accion' => 'carrera_do_asignar_establecimiento',
                        'titulo' => 'carrera',
            ));
        }
    }

    /**
     * genera el array de formularios para asignar los establecimientos
     * @param type $carrera
     * @return type
     */
    private function getEstablecimientosForms($carrera) {
        // FALTA Los establecimientos que tienen la carrera asignada y tiene cohortes deberían aparecer disable
        //para que no se pueda eliminar nada

        /**
         * array usado
         * localizaciones[][(localizacion)localizacion]
         * localizaciones[][establecimiento_nombre]
         * localizaciones[][localizacion_id]
         * localizaciones[][establecimiento_edificio_nombre]
         */
        $resultado = array();

        //obtengo la lista de establecimientos ordenados
        //cada sede/anexo es una entrada en la lista por que la carrera se asigna a la localizacion del establecimiento
        $localizaciones = $this->getEm()
                ->getRepository('EstablecimientoBundle:Localizacion')
                ->findTerciarios();

        //genero un array con los formuarios tal como se va a mostrar
        foreach ($localizaciones as $key => $una_localizacion) {
            $resultado[] = $this->crearAsignarForm(
                            $una_localizacion, $carrera, $key
                    )
                    ->createView();
        };

        return $resultado;
    }

    /**
     * Crea un formulario para una localizacion
     * Cada formulario tiene un nombre diferente dado por $nro_form
     * 
     * @param type $carrera_id
     * @param type $establecimiento_id
     * @param type $accion
     * @param type $nro_form
     */
    private function crearAsignarForm($una_localizacion, Carrera $carrera, $nro_form) {

        //vertifica si en esa localizacion se está impartiendo la carrera
        $se_imparte = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->findSeImparte($una_localizacion['localizacion'], $carrera);

        $nombre = $una_localizacion['establecimiento_nombre']
                .
                ($una_localizacion['establecimiento_edificio_nombre'] ? ' - ' . $una_localizacion['establecimiento_edificio_nombre'] : '');

        $data = array(
            'nombre' => $nombre,
            'carrera_id' => $carrera->getId(),
            'localizacion_id' => $una_localizacion['localizacion_id'],
            'accion_del_form' => $se_imparte ? 'Desasignar' : 'Asignar',
        );

        $form = $this->get('form.factory')
                ->createNamedBuilder('form' . $nro_form, 'form', $data)
                ->add('nombre', 'text', array(
                    'attr' => array('class' => 'input_talle_5'),
                    'disabled' => true,
                    'required' => false,
                    'label' => ' ',
                ))
                ->add('carrera_id', 'hidden')
                ->add('localizacion_id', 'hidden')
                ->add('accion_del_form', 'hidden')
                ->getForm();

        return $form;
    }

    /**
     * Despliega una pàgina donde se muestra un fiedset con los establecimientos donde se dicta una carrera
     * 
     * @Route("/nomina_donde_se_dicta/{carrera_id}", name="carrera_nomina_donde_se_dicta")
     */
    public function nomina_donde_se_dictaAction($carrera_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $carrera = $em->getRepository('OfertaEducativaBundle:Carrera')->find($carrera_id);
        return $this->render('OfertaEducativaBundle:Carrera:nomina_donde_se_dicta.html.twig', array(
                    'carrera' => $carrera,
        ));
    }

    /**
     * @Route("/nomina", name="carrera_nomina")
     */
    public function nominaAction() {
        $paginador = $this->get('ideup.simple_paginator');

        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_largo'));

        $carreras = $paginador->paginate(
                        $this->getDoctrine()->getEntityManager()->getRepository('OfertaEducativaBundle:Carrera')
                                ->qyAllOrdenado('nombre')
                )->getResult();

        return $this->render('OfertaEducativaBundle:Carrera:nomina.html.twig', array(
                    'carreras' => $carreras,
        ));
    }

    /**
     * DEPRECATED no tiene sentido
     * 
     * Saca la lista de carreras activas pero por nombre: una fila por cada nombre.
     * Por el momento hay más de una carrera con el mismo nombre. Acá sale sólo una vez.
     * 
     * @Route("/nomina_resumida", name="carrera_nomina_resumida")
     */
//    public function nomina_resumidaAction() {
//
//        $paginador = $this->get('ideup.simple_paginator');
//
//        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_largo'));
//
//        $carreras = $paginador->paginate(
//                        $this->getDoctrine()
//                                ->getEntityManager()
//                                ->getRepository('OfertaEducativaBundle:Carrera')
//                                ->qyResumido()
//                )->getResult();
//
//        return $this->render('OfertaEducativaBundle:Carrera:nomina_resumida.html.twig', array(
//                    'carreras' => $carreras,
//        ));
//    }

    /**
     * @Route("/nomina_resumida_donde_se_dicta/{carrera_id}", name="carrera_nomina_resumida_donde_se_dicta")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={"id"="carrera_id"})
     */
    public function nomina_resumida_donde_se_dictaAction(Carrera $carrera) {

        $donde_se_dicta = array();

        // recupero todas las carreras que tienen igual nombre
        $carreras = $this->getRepo()
                ->findBy(array('nombre' => $carrera->getNombre()));

        $repo_establecimiento = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento');

        // inicializo el ìndice del array de establecimientos resultado
        $i = 0;

        /**
         * Recupero los establecimientos donde se dictan las carreras.
         * Las carreras son varias y puede haber más de una con el mismo nombre, que se den en establecimientos distintos.
         * Voy a recuperar todas las unidades_educativas donde se da cada carrera en un ArrayCollection con las unidades_ofertas
         * pero todas juntas las de distintos id de carreras.
         */
        $unidades_ofertas = new ArrayCollection();

        foreach ($carreras as $carrera) {

            //las unidad_oferta de una carrera
            $unidades_oferta = $carrera->getOferta()->getUnidades();

            //cargo las unidad_oferta en otro array de a una
            foreach ($unidades_oferta as $unidad_oferta) {
                $unidades_ofertas->add($unidad_oferta);
            }
        }

        return $this->render('OfertaEducativaBundle:Carrera:nomina_reducida_donde_se_dicta.html.twig', array(
                    'carrera' => $carrera,
                    'unidades_ofertas' => $unidades_ofertas,
        ));
    }

    /**
     * @Route("/buscar_planilla_de_calculo", name="carrera_buscar_planilla_de_calculo")
     */
    public function buscar_planilla_de_calculoAction() {
        //en la sesión puede ser que esté giardado el filtro de busqueda
        
        $filename = "Carreras.xls";

        // ask the service for a Excel5
        $excelService = $this->get('phpexcel');

        $excelObj = $excelService->createPHPExcelObject();

        $active_sheet_index = $excelObj->setActiveSheetIndex(0);

        $filterBuilder = $this
                ->getRepo()
                ->qbAllOrdenado('nombre');

         // si en la sesiòn hay datos del filtro, los tomo para construir el querybuilder
        $session = $this->getRequest()->getSession();
        
        if ($session->has('datos')) {
            //si existen ls datos en la sesion se los toma
            $filterData = $session->get('datos');       
            
            //se crea el oformulario con los datos de la sesion
            $form = $this->crearFormBusqueda($filterData);
            
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            
            $carreras = $filterBuilder->getQuery()->getResult();
        }            
        
        $active_sheet_index->setCellValue('A1', 'Dirección de Formación Docente');
        $active_sheet_index->setCellValue('A2', 'Listado de carreras activas');

        $fila = 5;

        //titulos
        $titulos = $fila - 1;
        $active_sheet_index->setCellValue('A' . $titulos, "#");
        $active_sheet_index->setCellValue('B' . $titulos, "Nombre");
        $active_sheet_index->setCellValue('C' . $titulos, "Estado");
        $active_sheet_index->setCellValue('D' . $titulos, "Norma");
        $active_sheet_index->setCellValue('E' . $titulos, "Tipo formación");

        foreach ($carreras as $carrera) {
            $active_sheet_index->setCellValue('A' . $fila, $fila - 4);
            $active_sheet_index->setCellValue('B' . $fila, $carrera->getNombre());
            $active_sheet_index->setCellValue('C' . $fila, $carrera->getEstado()->getDescripcion());
            $norma = ( $carrera->getNorma() ? $carrera->getNorma()->__toString() : 'sin datos');
            $active_sheet_index->setCellValue('D' . $fila, $norma);
            $active_sheet_index->setCellValue('E' . $fila, $carrera->getFormacion()->__toString());
            $fila += 1;
        }
        $excelObj->getActiveSheet()->setTitle('Carreras activas');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelObj->setActiveSheetIndex(0);

        // create the writer
        $writer = $excelService->createWriter($excelObj, 'Excel5');
        // create the response
        $response = $excelService->createStreamedResponse($writer);
        //create the response
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . $filename);

        // If you are using a https connection, you have to set those two headers for compatibility with IE <9
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        return $response;
    }


    /**
     * @Route("/indicadores_cohorte", name="carrera_indicadores_cohorte")
     */
    public function indicadores_cohorteAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $establecimientos = $em->getRepository('EstablecimientoBundle:Establecimiento')->findTienenCohortes();
        return $this->render('OfertaEducativaBundle:Carrera:indicadores_cohorte.html.twig', array(
                    'establecimientos' => $establecimientos,
        ));
    }

    /**
     * @Route("/indicadores_cohorte_estalecimiento/{establecimiento_id}", name="carrera_indicadores_cohorte_establecimiento")
     */
    public function indicadores_cohorte_establecimientoAction($establecimiento_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('EstablecimientoBundle:UnidadOferta');
        $unidad_ofertas = $repo->findCarrerasConCohortes($establecimiento_id);

        //muestra todas las ofertas educativas tipo carrera de un establecimiento
        return $this->render('OfertaEducativaBundle:Carrera:indicadores_cohorte_establecimiento.html.twig', array(
                    'unidad_ofertas' => $unidad_ofertas,
        ));
    }

    /**
     * @Route("/indicadores_cohorte_unidad_oferta/{unidad_oferta_id}", name="carrera_indicadores_cohorte_unidad_oferta")
     */
    public function indicadores_cohorte_unidad_ofertaAction($unidad_oferta_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $unidad_oferta = $em->getRepository('EstablecimientoBundle:UnidadOferta')->find($unidad_oferta_id);
//        
//        //muestra todas las ofertas educativas tipo carrera de un establecimiento
        return $this->render('OfertaEducativaBundle:Carrera:indicadores_cohorte_unidad_oferta.html.twig', array(
                    'unidad_oferta' => $unidad_oferta,
        ));
    }

//DEPRECATED se deja como modelo de lo que se haga luego
//    /**
//     * entrega una lista de establecimientos 
//     * en la plantilla se selecciona un establecimiento y se va a mostrar la nómina de carreras del establecimiento
//     * 
//     * @Route("/resumen_validez", name="carrera_resumen_validez")
//     */
//    public function resumen_validezAction() {
//        $em = $this->getDoctrine()->getEntityManager();
//        $establecimientos = $em->getRepository('EstablecimientoBundle:Establecimiento')->findAllOrdenado('orden');
//        return $this->render('OfertaEducativaBundle:Carrera:resumen_validez.html.twig', array(
//                    'establecimientos' => $establecimientos,
//        ));
//    }
//DEPRECATED se deja como modelo de lo que se haga luego
//    /**
//     * @Route("/resumen_validez_establecimiento/{establecimiento_id}", name="carrera_resumen_validez_establecimiento")
//     */
//    public function resumen_validez_establecimientoAction($establecimiento_id) {
//        $em = $this->getDoctrine()->getEntityManager();
//        $establecimiento = $em->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);
//        $repo = $em->getRepository('OfertaEducativaBundle:Carrera');
//        $carreras = $repo->findCarrerasPorEstablecimiento($establecimiento);
//        return $this->render('OfertaEducativaBundle:Carrera:resumen_validez_establecimiento.html.twig', array(
//                    'carreras' => $carreras,
//        ));
//    }
//DEPRECATED se deja como modelo de lo que se haga luego
//    /**
//     * @Route("/resumen_validez_carrera/{carrera}", name="carrera_resumen_validez_carrera")
//     */
//    public function resumen_validez_carreraAction($carrera, $clase_css) {
//        return $this->render('OfertaEducativaBundle:Carrera:resumen_validez_carrera.html.twig', array(
//                    'carrera' => $carrera,
//                    'clase_css' => $clase_css,
//        ));
//    }

    /**
     * muestra un cuadro de matricula de las ultimas 3 años de la carrera 
     * para cada una de los establecimientos en los que se dicta
     * 
     * @Route("/cuadro_matricula/{carrera_id}", name="carrera_cuadro_matricula")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={"id"="carrera_id"})
     * @Template("OfertaEducativaBundle:Carrera:cuadro_matricula.html.twig")
     *      */
    public function cuadro_matriculaAction(Carrera $carrera) {

        $repositorio_unidad_oferta = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta');

        $unidades_ofertas = $repositorio_unidad_oferta->findUnidadOferta(null, $carrera, true);

        //se prepara un array para el formato del cuadro de salida
        //se filtran los últimos 4 años
        $salida = [];
        $un_establecimiento = [];
        $hoy = date("Y");
        $anio_desde = $hoy - 2;

        foreach ($unidades_ofertas as $una_unidad_oferta) {

            $establecimiento_edificio = $repositorio_unidad_oferta->findSedeAnexo($una_unidad_oferta);
            $un_establecimiento['nombre_anexo'] = $establecimiento_edificio->__toString();
            $un_establecimiento['establecimiento_id'] = $establecimiento_edificio->getEstablecimientos()->getId();
            $un_establecimiento['orden'] = $establecimiento_edificio->getEstablecimientos()->getOrden();
            $cohortes = $una_unidad_oferta->getCohortes();

            $un_establecimiento['cohortes'] = array();
            foreach ($cohortes as $una_cohorte) {
                if ($una_cohorte->getAnio() <= $hoy and $una_cohorte->getAnio() >= $anio_desde) {
                    $un_establecimiento['cohortes'][$una_cohorte->getAnio()]['ingresantes'] = $una_cohorte->getMatriculaIngresantes();
                    $un_establecimiento['cohortes'][$una_cohorte->getAnio()]['matricula'] = $una_cohorte->getMatricula();
                    $un_establecimiento['cohortes'][$una_cohorte->getAnio()]['graduados'] = $una_cohorte->getEgreso();
                }
            }
            $salida[] = $un_establecimiento;
        };

        //funcion para ordenar la lista de establecimientos segùn un orden predeterminado de la entity
        $ordenar = function ($elemento1, $elemento2) {

            if ($elemento1["orden"] == $elemento2["orden"])
                return 0;

            if ($elemento1["orden"] < $elemento2["orden"])
                return -1;
            return 1;
        };

        usort($salida, $ordenar);

        return array(
            'unidades_ofertas' => $unidades_ofertas,
            'carrera' => $carrera,
            'salida' => $salida,
            'anio_desde' => $anio_desde,
            'anio_hasta' => $hoy,
        );
    }

    /**
     * @Route("/tarjeta_carrera/{carrera_id}", name="tarjeta_carrera")
     */
    public function tarjeta_carreraAction($carrera_id) {
        $carrera = $this->getDoctrine()->getRepository('OfertaEducativaBundle:Carrera')->find($carrera_id);

        return $this->render('OfertaEducativaBundle:Carrera:tarjeta_carrera.html.twig', array(
                    'carrera' => $carrera,
        ));
    }

    /**
     * FALTA migrar. Estaba en el normacontroller frontal
     * 
     * @Route("/norma_vincular_carrera/{carrera_id}/{norma_id}", name="norma_vincular_carrera")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={ "id"="carrera_id"} )
     * @ParamConverter("norma", class="OfertaEducativaBundle:Norma", options={ "id"="norma_id"} )
     */
    public function vincularNormaAction($carrera, $norma) {
        $carrera_manager = new CarreraManager($this->getEm());

        $respuesta = $carrera_manager->vincular_norma($carrera, $norma);

//        $respuesta = $em->getRepository('OfertaEducativaBundle:Carrera')->vincularNorma($carrera_id, $norma);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('carrera_editar', array('id' => $carrera->getId())));
    }

    /**
     * testeado
     * desvincula una norma previamente vinculada a una carrera
     * 
     * @Route("/desvincular_norma/{carrera_id}/{norma_id}", name="carrera_desvincular_norma")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={"id"="carrera_id"} )
     * @ParamConverter("norma", class="OfertaEducativaBundle:Norma", options={"id"="norma_id"} )
     */
    public function desvincularNormaAction($carrera, $norma) {
        $carrera_manager = new CarreraManager($this->getEm());

        $respuesta = $carrera_manager->desvincular_norma($carrera, $norma);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('carrera_editar', array('id' => $carrera->getId())));
    }

}
