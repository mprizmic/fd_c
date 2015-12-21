<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno;
use Fd\EstablecimientoBundle\EventListener\DownloadListener;
use Fd\EstablecimientoBundle\Model\PlanillaSedesYAnexos;
use Fd\EstablecimientoBundle\Repository\UnidadOfertaRepository;
use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

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
    public function fichaAction($establecimiento, Request $request) {
        
        // establezco la ruta para la pagina que tenga que volver aca
        $this->get('session')->set('ruta_completa', $request->get('_route'));
        $this->get('session')->set('parametros', $request->get('_route_params'));

        //repositorio de establecimiento
        $repository = $this->getDoctrine()->getRepository('EstablecimientoBundle:Establecimiento');

        //esto es para el menu de la derecha
        $establecimientos = $repository->qyAllOrdenado('orden')->getResult();

        //son obj establecimiento_edificio
        $sede_anexos = $repository->findSedeYAnexo($establecimiento);

        /**
         * sede_anexo_array[][id]
         * sede_anexo_array[][cue_anexo]
         * sede_anexo_array[][cue_anexo][te]
         * sede_anexo_array[][cue_anexo][email]
         * sede_anexo_array[][domicilio][calle]
         * sede_anexo_array[][domicilio][altura]
         * sede_anexo_array[][domicilio][barrio]
         * sede_anexo_array[][domicilio][cp]
         * sede_anexo_array[][domicilio][inspector]
         * 
         * sede_anexo_array[][agenda]
         * sede_anexo_array[][agenda][oi][id]
         * sede_anexo_array[][agenda][oi][nombre_dependencia]
         * sede_anexo_array[][agenda][oi][te]
         * sede_anexo_array[][agenda][oi][plantel][nombre_cargo]
         * sede_anexo_array[][agenda][oi][plantel][autoridad][id]
         * sede_anexo_array[][agenda][oi][plantel][autoridad][apellido]
         * sede_anexo_array[][agenda][oi][plantel][autoridad][nombre]
         * sede_anexo_array[][agenda][oi][plantel][autoridad][te_particular] | AD
         * sede_anexo_array[][agenda][oi][plantel][autoridad][celular] | AD
         * sede_anexo_array[][agenda][oi][plantel][autoridad][email] | AD
         * 
         * sede_anexo_array[][unidad_educativas][][nivel]
         * sede_anexo_array[][unidad_educativas][][nivel_id]
         * sede_anexo_array[][unidad_educativas][][nivel_abreviatura]
         * sede_anexo_array[][unidad_educativas][][nivel_orden]
         * sede_anexo_array[][unidad_educativas][][cantidad_docentes]
         * sede_anexo_array[][unidad_educativas][][localizacion_id]
         * sede_anexo_array[][unidad_educativas][][matricula]
         * 
         * sede_anexo_array[][unidad_educativas][][ofertas][][unidad_oferta_id][]
         * sede_anexo_array[][unidad_educativas][][ofertas][][salas_inicial][]
         * sede_anexo_array[][unidad_educativas][][ofertas][][turnos][]
         * sede_anexo_array[][unidad_educativas][][ofertas][][tipo]
         * sede_anexo_array[][unidad_educativas][][ofertas][][carrera]
         * sede_anexo_array[][unidad_educativas][][ofertas][][carrera_id]
         * 
         * sede_anexo_array[][unidad_educativas][][turnos_nivel][]
         * 
         * sede_anexo_array[][unidad_educativas][][cantidad_docentes][]
         */
        foreach ($sede_anexos as $key => $sede_anexo) {

            $domicilio = $sede_anexo->getEdificios()->getDomicilioPrincipal();

            $te = $this->getEm()
                    ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                    ->findTe($sede_anexo);
            
            $sede_anexo_array[$key]['id'] = $sede_anexo->getId();
            $sede_anexo_array[$key]['cue_anexo']['digito'] = $sede_anexo->getCueAnexo();
            $sede_anexo_array[$key]['cue_anexo']['te'] = $te;
            $sede_anexo_array[$key]['cue_anexo']['email'] = $sede_anexo->getEmail();
            

            $sede_anexo_array[$key]['domicilio']['calle'] = $domicilio->getCalle();
            $sede_anexo_array[$key]['domicilio']['altura'] = $domicilio->getAltura();
            $sede_anexo_array[$key]['barrio'] = $sede_anexo->getEdificios()->getBarrio();
            $sede_anexo_array[$key]['cp'] = $domicilio->getCPostal();

            $inspector = $sede_anexo->getEdificios()->getInspector();

            if ($inspector) {
                $sede_anexo_array[$key]['inspector'] = $inspector->datosCompletos();
            } else {
                $sede_anexo_array[$key]['inspector'] = 'sin datos';
            }

            //agenda
            $agenda = array();

            $organizaciones = $this->getEm()
                    ->getRepository('EstablecimientoBundle:OrganizacionInterna')
                    ->findUnaSede($sede_anexo->getId());

            foreach ($organizaciones as $key_oi => $organizacion) {
                $agenda[$key_oi]['id'] = $organizacion->getId();
                $agenda[$key_oi]['nombre_dependencia'] = $organizacion->getDependencia()->getNombre();
                $agenda[$key_oi]['te'] = $organizacion->getTe();

                $cargos = array();

                $plantel = $organizacion->getCargos();

                foreach ($plantel as $key_pe => $un_plantel) {
                    $cargos[$key_pe]['nombre_cargo'] = $un_plantel->getCargo()->getNombre();

                    $autoridad = $un_plantel->getAutoridad();
                    //el cargo puede no estar asignado a una persona
                    $existe = ($autoridad) ? true : false;

                    $cargos[$key_pe]['autoridad']['id'] = ($existe) ? $autoridad->getId() : $existe; //asigna un "0" por el valor false 
                    $cargos[$key_pe]['autoridad']['nombre_autoridad'] = ($existe) ? $autoridad->getApellido() . ', ' . $autoridad->getNombre() : $existe;
                    $cargos[$key_pe]['autoridad']['te_particular'] = ($existe) ? $autoridad->getTeParticular() : $existe;
                    $cargos[$key_pe]['autoridad']['celular'] = ($existe) ? $autoridad->getCelular() : $existe;
                    $cargos[$key_pe]['autoridad']['email'] = ($existe) ? $autoridad->getEmail() : $existe;
                }

                $agenda[$key_oi]['plantel'] = $cargos;
            }

            $sede_anexo_array[$key]['agenda'] = $agenda;


            // todas las unidades educativas

            $unidad_educativas = array();
            foreach ($sede_anexo->getLocalizacion() as $key2 => $localizacion) {

                $nivel = $localizacion->getUnidadEducativa()->getNivel();

                $unidad_educativas[$key2] = array();
                $unidad_educativas[$key2]['nivel'] = $nivel->getNombre();
                $unidad_educativas[$key2]['nivel_id'] = $nivel->getId();
                $unidad_educativas[$key2]['nivel_abreviatura'] = $nivel->getAbreviatura();
                //se carga a los efectos del ordenamiento
                $unidad_educativas[$key2]['nivel_orden'] = $nivel->getOrden();
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

            //se ordenan los niveles
            usort($unidad_educativas, function($a, $b) {
                return $a['nivel_orden'] - $b['nivel_orden'];
            });

            $sede_anexo_array[$key]['unidad_educativas'] = $unidad_educativas;

            /**
             * turnos en que funciona la oferta de cada nivel de cada sede
             * se calcula por el nivel de la unidad_oferta
             * puede haber unidad_oferta con turno distinto de nivel repetido y hay que considerarlo
             * ej: carrrera 1 TM y TV, carrera 2 TV y TT. El resultado es que Terciario tiene TM. TT y TV
             */
        }

        return array(
            //todos los datos separador por localizacion
            'datos_localizados' => $sede_anexo_array,
            //el establecimiento en tratamiento
            'establecimiento' => $establecimiento,
            //toda la lista de establecimientos para hacer el menu derecho
            'establecimientos' => $establecimientos,
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
     * @DownloadAs(filename="Establecimientos.xls")
     */
    public function establecimiento_salida_planillaAction() {

        //se usa el mismo formato de listado para establecimientos y para sedes y anexos
        $establecimientos_edificios = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->findSedesOrdenados();

        //se crea el servicio para crear planillas
        $excelService = $this->get('phpexcel');

        // defino la planilla
        $planilla = new PlanillaSedesYAnexos($excelService, 'Listado de establecimientos', $establecimientos_edificios, $this->getEm());

        //genero la planilla y devuelve un response
        $response = $planilla->generarPlanillaResponse();

        return $response;
    }

}
