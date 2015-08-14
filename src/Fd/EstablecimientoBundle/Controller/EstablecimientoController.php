<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno;
use Fd\EstablecimientoBundle\Repository\UnidadOfertaRepository;

/**
 * @Route("/")
 */
class EstablecimientoController extends Controller {

    private $em;
    private $repositorio;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepositorio() {
        return $this->getEm()
                        ->getRepository('EstablecimientoBundle:Establecimiento');
    }

    /**
     * Emite un listado con los establecimientos que cumplen aniversarios significativos en los próximos años
     * @Route("/aniversarios_significativos", name="establecimiento_aniversarios_significativos")
     */
    public function aniversarios_significativosAction() {

        // intervalos de interes
        $intervalos = $this->container->getParameter('fd.aniversarios.significativos');

        $establecimientos = $this->getRepositorio()
                ->findFechasCreacion();

        foreach ($establecimientos as $key => $establecimiento) {
            $this->proximo_aniversario($establecimiento, $intervalos);
            $aniversarios[] = $this->proximo_aniversario($establecimiento, $intervalos);
        }

        //ordenar el vector por el campo anio_calendario
        function build_sorter($clave) {
            return function ($a, $b) use ($clave) {
                return strnatcmp($a[$clave], $b[$clave]);
            };
        }

        usort($aniversarios, build_sorter('anio_calendario'));

        //se buscan los establecimientos que no tienen cargada la fecha de creación para imformarlos en el listado
        $establecimientos_sin_fecha = $this->getRepositorio()->findFechasCreacion(false);

        return $this->render('EstablecimientoBundle:Default:aniversarios_significativos.html.twig', array(
                    'aniversarios' => $aniversarios,
                    'intervalos' => $intervalos,
                    'establecimientos_sin_fecha' => $establecimientos_sin_fecha,
                ))
        ;
    }

    private function proximo_aniversario($establecimiento, $intervalos) {

        // le calculo la edad al establecimiento
        $anio_creacion = substr($establecimiento['fecha_creacion'], 6, 4);
        $edad = date('Y') - $anio_creacion;

        //veo cual es el aniversario que está por cumplir
        $aniversario = 0;
        foreach ($intervalos as $value) {
            if ($edad <= $value) {
                $aniversario = $value;
                break;
            };
        }

        $establecimiento['aniversario'] = $aniversario;
        $establecimiento['anio_calendario'] = $anio_creacion + $aniversario;

        return $establecimiento;
    }

    /**
     * Listado de docentes por nivel de cada establecimiento
     *
     * @Route("/docentes_nivel_listado", name="establecimiento_docentes_nivel_listado")
     */
    public function docentesNivelListadoAction() {

        $establecimiento_edificios = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->findAllOrdenado('orden');

        return $this->render('EstablecimientoBundle:Default:docentes_nivel_listado.html.twig', array(
                    'establecimiento_edificios' => $establecimiento_edificios,
                ))
        ;
    }

    /**
     * @Route("/damero", name="establecimiento_damero")
     */
    public function dameroAction() {
        $paginador = $this->get('ideup.simple_paginator');

//        establecimientos paginados
        $establecimientos = $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')
                        ->qyAllOrdenado('orden')->getResult();

        return $this->render('EstablecimientoBundle:Default:damero.html.twig', array(
                    'establecimientos' => $establecimientos,
        ));
    }

    /**
     * @Route("/establecimiento_de_un_cui/{edificio_id}", name="establecimiento_de_un_cui")
     * @ParamConverter("edificio", class="EdificioBundle:Edificio", options={"id":"edificio_id"})
     */
    public function establecimiento_de_un_cuiAction($edificio) {
        $establecimiento_edificios = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->findDeUnCui($edificio);

        return $this->render('EstablecimientoBundle:Default:establecimiento_de_un_cui.html.twig', array(
                    'establecimiento_edificios' => $establecimiento_edificios,
                    'edificio_id' => $edificio->getId(),
        ));
    }

    /**
     * @Route("/ficha/{establecimiento_id}", name="establecimiento_ficha")
     * @Template("EstablecimientoBundle:Default:ficha.html.twig")
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento", options={"id"="establecimiento_id"})
     */
    public function fichaAction($establecimiento) {
        $request = $this->getRequest();

        // establezco la ruta para la pagina que tenga que volver aca
        $this->get('session')->set('ruta_completa', $request->get('_route'));
        $this->get('session')->set('parametros', $request->get('_route_params'));

        //repositorio de establecimiento
        $repo = $this->getDoctrine()->getRepository('EstablecimientoBundle:Establecimiento');

        $establecimientos = $repo->qyAllOrdenado('orden')->getResult();

        //son obj establecimiento_edificio
        $establecimiento_edificios = $repo->findSedeYAnexo($establecimiento);

        foreach ($establecimiento_edificios as $key => $establecimiento_edificio) {

            $domicilio = $establecimiento_edificio->getEdificios()->getDomicilioPrincipal();

            $establecimiento_edificio_array[$key]['id'] = $establecimiento_edificio->getId();
            $establecimiento_edificio_array[$key]['cue_anexo'] = $establecimiento_edificio->getCueAnexo();

            $establecimiento_edificio_array[$key]['domicilio']['calle'] = $domicilio->getCalle();
            $establecimiento_edificio_array[$key]['domicilio']['altura'] = $domicilio->getAltura();

            $datos_grales['te'] = $establecimiento_edificio->getTe1();
            $datos_grales['barrio'] = $establecimiento_edificio->getEdificios()->getBarrio();
            $datos_grales['cp'] = $domicilio->getCPostal();
            $datos_grales['email'] = $establecimiento_edificio->getEmail1();
            
        $inspector = $establecimiento_edificio->getEdificios()->getInspector();
            
            if ($inspector){
            $datos_grales['inspector'] = $inspector->datosCompletos();
            }else{
                $datos_grales['inspector'] = 'sin datos';
            }
            
            $establecimiento_edificio_array[$key]['datos_grales'] = $datos_grales;

            /**
             * establecimiento_edificio_array[][id]
             * establecimiento_edificio_array[][cue_anexo]
             * establecimiento_edificio_array[][domicilio][calle]
             * establecimiento_edificio_array[][domicilio][altura]
             * establecimiento_edificio_array[][datos_grales][te]
             * establecimiento_edificio_array[][datos_grales][barrio]
             * establecimiento_edificio_array[][datos_grales][cp]
             * establecimiento_edificio_array[][datos_grales][email]
             * establecimiento_edificio_array[][unidad_educativas][][nivel]
             * establecimiento_edificio_array[][unidad_educativas][][nivel_id]
             * establecimiento_edificio_array[][unidad_educativas][][nivel_abreviatura]
             * establecimiento_edificio_array[][unidad_educativas][][ofertas][][unidad_oferta_id][]
             * establecimiento_edificio_array[][unidad_educativas][][ofertas][][salas_inicial][]
             * establecimiento_edificio_array[][unidad_educativas][][ofertas][][turnos][]
             * establecimiento_edificio_array[][unidad_educativas][][ofertas][][tipo]
             * establecimiento_edificio_array[][unidad_educativas][][ofertas][][carrera]
             * establecimiento_edificio_array[][unidad_educativas][][ofertas][][carrera_id]
             * establecimiento_edificio_array[][unidad_educativas][][turnos_nivel][]
             * establecimiento_edificio_array[][unidad_educativas][][cantidad_docentes][]
             */
            $unidad_educativas = array();
            foreach ($establecimiento_edificio->getLocalizacion() as $key2 => $localizacion) {

                $nivel = $localizacion->getUnidadEducativa()->getNivel();

                $unidad_educativas[$key2] = array();
                $unidad_educativas[$key2]['nivel'] = $nivel->getNombre();
                $unidad_educativas[$key2]['nivel_id'] = $nivel->getId();
                $unidad_educativas[$key2]['nivel_abreviatura'] = $nivel->getAbreviatura();
                $unidad_educativas[$key2]['cantidad_docentes'] = $localizacion->getCantidadDocentes();
                $unidad_educativas[$key2]['localizacion_id'] = $localizacion->getId();
                $unidad_educativas[$key2]['matricula'] = $localizacion->getMatricula();


                /**
                 * de cada localizacion se toman todas sus unidades ofertas asociadas al nivel
                 */
                $unidad_ofertas = array();
                foreach ($localizacion->getOfertas() as $key_uo => $unidad_oferta) {
                    $unidad_ofertas[$key_uo]['unidad_oferta_id'] = $unidad_oferta->getId();
                    $unidad_ofertas[$key_uo]['salas_inicial'] = 'salas_inicial';
                    $unidad_ofertas[$key_uo]['turnos'] = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')->findTurnosArray($unidad_oferta);
                    $tipo = $unidad_oferta->getOfertas()->esTipo();
                    $unidad_ofertas[$key_uo]['tipo'] = $tipo;
                    if ($tipo == 'Carrera') {
                        $carrera = $unidad_oferta->getOfertas()->getCarrera();
                        $unidad_ofertas[$key_uo]['carrera'] = $carrera->getIdentificacion();
                        $unidad_ofertas[$key_uo]['carrera_id'] = $carrera->getId();
                    }
                }
                /**
                 * guardo todas las ofertas de un nivel
                 */
                $unidad_educativas[$key2]['ofertas'] = $unidad_ofertas;

                $unidad_educativas[$key2]['turnos_nivel'] = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->findTurnos($localizacion);
            }

            $establecimiento_edificio_array[$key]['unidad_educativas'] = $unidad_educativas;

            /**
             * turnos en que funciona la oferta de cada nivel de cada sede
             * se calcula por el nivel de la unidad_oferta
             * puede haber unidad_oferta con turno distinto de nivel repetido y hay que considerarlo
             * ej: carrrera 1 TM y TV, carrera 2 TV y TT. El resultado es que Terciario tiene TM. TT y TV
             */
        }

        return array(
            //todos los datos separador por localizacion
            'datos_localizados' => $establecimiento_edificio_array,
            //el establecimiento en tratamiento
            'establecimiento' => $establecimiento,
            //toda la lista de establecimientos para hacer el menu derecho
            'establecimientos' => $establecimientos,
            'establecimiento_edificios' => $establecimiento_edificios, //deprecated
        );
    }

    /**
     * @Route("/nomina", name="establecimiento_nomina")
     */
    public function nominaAction() {
        $paginador = $this->get('ideup.simple_paginator');

        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

//        establecimientos paginados
        $establecimientos = $paginador->paginate(
                        $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')
                                ->qyAllOrdenado('orden')
                )->getResult();

        return $this->render('EstablecimientoBundle:Default:nomina.html.twig', array(
                    'establecimientos' => $establecimientos,
        ));
    }

    /**
     * devuelve el nro siguiente al del nro de anexo más alto existente para un establecimiento
     * Devuelve el dato en json.
     * @Route("/nuevo_anexo/{id}", name="establecimiento_nuevo_anexo")
     */
    public function nuevoNroAnexoAction($id, Request $resquest) {
        $establecimiento = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->find($id);

        if (!$establecimiento) {
            throw $this->createNotFoundException($message = "No existe el establecimiento");
        };

        //calculo el nuevo nro de anexo
        $nuevo = $establecimiento->getNroNuevoAnexo();

        $datos = array("responseCode" => 200, "respuesta" => $nuevo);
        $response = new Response();
        $response->setContent(json_encode($datos));
        $response->headers->set('content-type', 'application/json');
        return $response;
    }

    /**
     * @Route("/tarjeta_establecimiento/{establecimiento_id}", name="tarjeta_establecimiento")
     */
    public function tarjeta_establecimientoAction($establecimiento_id) {
        $establecimiento = $this->getDoctrine()->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);

        return $this->render('EstablecimientoBundle:Default:tarjeta_establecimiento.html.twig', array(
                    'establecimiento' => $establecimiento,
        ));
    }

    /**
     * @Route("/tarjeta_establecimiento_edificio/{establecimiento_edificio_id}", name="tarjeta_establecimiento_edificio")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id", "establecimiento_edificio_id"})
     */
    public function tarjeta_establecimiento_edificioAction($establecimiento_edificio) {

        return $this->render('EstablecimientoBundle:Default:tarjeta_establecimiento_edificio.html.twig', array(
                    'establecimiento_edificio' => $establecimiento_edificio,
        ));
    }

    /**
     * @Route("/salida_planilla", name="establecimiento_salida_planilla")
     */
    public function establecimiento_salida_planillaAction() {

        $filename = "Establecimientos.xls";

        // ask the service for a Excel5
        $excelService = $this->get('phpexcel');

        $excelObj = $excelService->createPHPExcelObject();

        $active_sheet_index = $excelObj->setActiveSheetIndex(0);

        $establecimientos = $this->getRepositorio()->findAllOrdenado('orden');

        $active_sheet_index->setCellValue('A1', 'Dirección de Formación Docente');
        $active_sheet_index->setCellValue('A2', 'Listado de establecimientos');
        $active_sheet_index->setCellValue('A3', 'Impreso: ' . date('d-m-Y'));

        $fila = 6;
        $numeracion = 1;
        $desplazamiento = $fila - $numeracion;

        //titulos
        $titulos = $fila - 1;
        $active_sheet_index->setCellValue('A' . $titulos, "#");
        $active_sheet_index->setCellValue('B' . $titulos, "Nombre");
        $active_sheet_index->setCellValue('C' . $titulos, "Domicilio");
        $active_sheet_index->setCellValue('D' . $titulos, "Barrio");
        $active_sheet_index->setCellValue('E' . $titulos, "Email");
        $active_sheet_index->setCellValue('F' . $titulos, "URL");
        $active_sheet_index->setCellValue('G' . $titulos, "TE");

        foreach ($establecimientos as $establecimiento) {
            
            $edificio_principal = $establecimiento->getEdificioPrincipal();
            
            $active_sheet_index->setCellValue('A' . $fila, $numeracion);
            $active_sheet_index->setCellValue('B' . $fila, $establecimiento->getNombre());
            $active_sheet_index->setCellValue('C' . $fila, $edificio_principal->getEdificios()->getDomicilioPrincipal()->__toString());
            $active_sheet_index->setCellValue('D' . $fila, $edificio_principal->getEdificios()->getBarrio()->__toString() );
            $active_sheet_index->setCellValue('E' . $fila, $edificio_principal->getEmail1() );
            $active_sheet_index->setCellValue('F' . $fila, $establecimiento->getUrl() );
            $active_sheet_index->setCellValue('G' . $fila, $edificio_principal->getTe1() );
            $fila += 1;
            $numeracion = $fila - $desplazamiento;
        }
        $excelObj->getActiveSheet()->setTitle('Establecimientos');
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
}