<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
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
     * Listado de docentes por nivel de cada establecimiento
     *
     * @Route("/docentes_nivel_listado", name="establecimiento_docentes_nivel_listado")
     */
    public function docentesNivelListadoAction() {

        $establecimientos = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->findAllOrdenado('orden');

        return $this->render('EstablecimientoBundle:Default:docentes_nivel_listado.html.twig', array(
                    'establecimientos' => $establecimientos,
                ))
        ;
    }

    /**
     * @Route("/cuadro_matricula/{establecimiento_id}/{tipo}", name="establecimientos_cuadro_matricula")
     * @Template("EstablecimientoBundle:Default:cuadro_matricula.html.twig")
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento", options={"id"="establecimiento_id"})
     */
    public function cuadro_matriculaAction($establecimiento, $tipo) {

        $hoy = date("Y");
        $anio_desde = $hoy - 2;

        //todas las carreras de un establecimiento
        $carreras = $this->getRepositorio()
                ->findCarreras($establecimiento);

        foreach ($carreras as $key => $value) {
            $una_carrera['nombre'] = $value->getNombre();
            $una_carrera['id'] = $value->getId();
            $una_carrera['cohortes'] = array();
            for ($i = $anio_desde; $i <= $hoy; $i++) {

                $datos = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')
                        ->findMatriculaCarrera($i, $value->getId(), $establecimiento->getId());
                //el resultado vienen en un array con key de cero en adelante
                //en este caso el resultado siempre es un solo array 
                $una_carrera['cohortes'][$i]['ingresantes'] = $datos[0]['matricula_ingresantes'];
                $una_carrera['cohortes'][$i]['matricula'] = $datos[0]['matricula'];
                $una_carrera['cohortes'][$i]['egreso'] = $datos[0]['egreso'];
            }
            $salida[] = $una_carrera;
        }

        return array(
            'unidades_ofertas' => null,
            'establecimiento' => $establecimiento,
            'salida' => $salida,
            'anio_desde' => $anio_desde,
            'anio_hasta' => $hoy,
        );
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
     */
    public function establecimiento_de_un_cuiAction($edificio_id) {
        $establecimientos = $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')->findDeUnCui($edificio_id);

        return $this->render('EstablecimientoBundle:Default:establecimiento_de_un_cui.html.twig', array(
                    'establecimientos' => $establecimientos,
                    'edificio_id' => $edificio_id,
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
        $establecimiento_edificios = $repo->findEdificios($establecimiento);
        
        foreach($establecimiento_edificios as $key => $establecimiento_edificio){
            
            $domicilio = $establecimiento_edificio->getEdificios()->getDomicilioPrincipal();
            
            $establecimiento_edificio_array[$key]['id'] = $establecimiento_edificio->getId();
            $establecimiento_edificio_array[$key]['cue_anexo'] = $establecimiento_edificio->getCueAnexo();
            
            $establecimiento_edificio_array[$key]['domicilio']['calle'] = $domicilio->getCalle();
            $establecimiento_edificio_array[$key]['domicilio']['altura'] = $domicilio->getAltura();
            
                $datos_grales['te'] = $establecimiento_edificio->getTe1();
                $datos_grales['barrio'] = $establecimiento_edificio->getEdificios()->getBarrio();
                $datos_grales['cp'] = $domicilio->getCPostal();
                $datos_grales['email'] = $establecimiento_edificio->getEmail1();
            
            
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
             */
            $unidad_educativas = array();
            foreach ($establecimiento_edificio->getLocalizacion() as $key2 => $localizacion) {
                
                $nivel = $localizacion->getUnidadEducativa()->getNivel();

                $unidad_educativas[$key2] = array();
                $unidad_educativas[$key2]['nivel'] = $nivel->getNombre();
                $unidad_educativas[$key2]['nivel_id'] = $nivel->getId();
                $unidad_educativas[$key2]['nivel_abreviatura'] = $nivel->getAbreviatura();

            
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
                    if ($tipo == 'Carrera'){
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
        

        //ver
//        $especializaciones = $repo->findEspecializaciones($establecimiento);
        
        //ver
//        $salas_inicial = $repo->findSalasInicial($establecimiento);
        
        //ver
//        $primario = $repo->findPrimario($establecimiento);
        
        //ver    debería ser por localizacion
        //son los objetos unidad_oferta para poder mostrar los turnos de cada oferta educativa de tipo carrera
        //representan el dictado de una carrera en el establecimiento en tratamiento
//        $localizaciones_terciario = $repo->findUnidadesOfertas($localizacion, "carrera");

        return array(
            //todos los datos separador por localizacion
            'datos_localizados' => $establecimiento_edificio_array,
            
            //el establecimiento en tratamiento
            'establecimiento' => $establecimiento,
            //toda la lista de establecimientos para hacer el menu derecho
            'establecimientos' => $establecimientos,
            
            
            'establecimiento_edificios' => $establecimiento_edificios, //deprecated
//            'edificio_principal' => $edificio_principal,
//            'carreras' => $carreras,
//            'especializaciones' => $especializaciones,
//            'salas_inicial' => $salas_inicial,
//            'primario' => $primario,
//            'unidad_ofertas' => $unidad_ofertas,
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

}
