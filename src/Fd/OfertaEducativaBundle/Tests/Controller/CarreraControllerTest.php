<?php

namespace Fd\OfertaEducativaBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;
use Fd\EstablecimientoBundle\Model\ConstantesTests;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Controller\CarreraController;

/**
 * testea el crud de establecimiento del backend
 */
class CarreraControllerTest extends LoginWebTestCase {

    public $manager;
    public $controlador;

    public function setUp() {
        parent::setup();

        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->manager = static::$kernel->getContainer()
                ->get('ofertaeducativa.carrera.manager');

        $this->controlador = new CarreraController();
    }

    /**
     * @dataProvider filtros
     */
    public function testBuscarAction($filtro) {
        $this->assertTrue($this->manager instanceof \Fd\OfertaEducativaBundle\Model\CarreraManager);

        $this->assertTrue($this->client instanceof \Symfony\Component\BrowserKit\Client);

        ///////////////

        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/buscar');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $formulario = $crawler->selectButton('Buscar')->form($filtro);

        //realiza una busqueda con estado ACTIVA
        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        //verifico que la cantidad de tr sea igual a la cantidad de activas
        //es una pagina entera así que son 15 más un título
        $this->assertEquals(16, $crawler->filter('tr')->count()
        );

        $this->assertEquals($crawler->filter('td:contains("Activa")')->count(), $crawler->filter('tr')->count() - 1);
    }

    public function filtros() {
        return array(
            array(
                array(
                    'carrera_filter[estado]' => ConstantesTests::ACTIVA,
                )
            )
        );
    }

//    public function generarDatosBusquedaPaginada($form) {
//    public function crearFormBusqueda($datos_sesion = null) {


    public function getComboFormaciones() {
        $controlador = $this->controlador;

        $datos_del_combo = $controlador->getComboFormaciones();

        $datos_bd = $this->manager
                ->getEm()
                ->getRepository('TablaBundle:TipoFormacion')
                ->findAll();

        //ambos tienen que tener igual cantidad
        $this->assertTrue(count($datos_bd) == count($datos_del_combo));
    }

//    public function obtenerCarrerasPaginadas($datos) {
    public function testNuevoAction() {

        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/nuevo');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Nueva carrera")')->count());
    }

    /**
     * @dataProvider carreras
     * @param type $carrera
     */
    public function testCrearAction($carrera) {

        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/nuevo');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $formulario = $crawler->selectButton('Crear')->form($carrera);

        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        $carreras = $this->manager->getRepository()->findBy(array('nombre' => 'TEST'));

        $this->assertTrue(!is_null($carrera) && (count($carreras) == 1));
    }

    public function carreras() {
        return array(
            array(
                array(
                    'carrera_type[nombre]' => 'TEST',
                    'carrera_type[duracion]' => 4,
                    'carrera_type[formacion]' => 1,
                    'carrera_type[estado]' => ConstantesTests::ACTIVA,
                    'carrera_type[anio_inicio]' => 2015,
                )
            )
        );
    }
    public function filtro_nombre() {
        return array(
            array(
                array(
                    'carrera_filter[nombre]' => 'TEST',
                )
            )
        );
    }
    /**
     * @dataProvider filtro_nombre
     */
    public function testEliminarAction($filtro) {
        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/buscar');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $formulario = $crawler->selectButton('Buscar')->form($filtro);

        //realiza una busqueda con nombre TEST
        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        //busca la fila de la carrera TEST y luego el link a la edición
        $link = $crawler->filter('td')->last()->children()->link();

        //hace click en el link
        $crawler = $client->click($link);

        // Selecciono el formulario de eliminacion
        $formulario = $crawler->selectButton('Eliminar')->form();

        // Envío el formulario de eliminacion
        $crawler = $client->submit($formulario);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testEditarAction() {
        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/editar/' . ConstantesTests::CARRERA_PROFESORADO_DE_PRIMARIA);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

//    private function createDeleteForm($id) {
    public function testComboAction($establecimiento_id = null) {

        $establecimiento = $this->manager->getEm()->getRepository('EstablecimientoBundle:Establecimiento')->findOneBy(array('apodo' => 'ISPEE'));

        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/combo/' . $establecimiento->getId());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

//        no funciona
//        $this->assertTrue($client->getResponse()
//                        ->headers
//                        ->contains(
//                                'Content-Type', 'application/json')
//        );

        $this->assertRegExp('/Especial/', $client->getResponse()->getContent());
    }

    /**
     * @dataProvider carreras
     * @param array $carrera
     */
    public function testActualizarAction($carrera) {

        $client = $this->client;

        //crea una nueva carrera
        $crawler = $client->request('GET', '/oferta/carrera/nuevo');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $formulario = $crawler->selectButton('Crear')->form($carrera);

        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());
        /**
         *  Prueba de modificación de un dato y grabación de lo editado
         */
        // Cambio un dato editado
        $carrera['carrera_type[nombre]'] = 'modificado test';

        // Selecciono el formulario de la página y lo lleno con el dataProvider modificado
        $formulario = $crawler->selectButton('Actualizar')->form($carrera);

        // Envío el formulario con datos de alta
        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        // Check que se grabó ok
        $this->assertEquals(
                $carrera['carrera_type[nombre]'], $crawler->filter('form input[name="carrera_type[nombre]"]')->attr('value')
        );

        //se borra lo creado
        // Selecciono el formulario de eliminacion
        $formulario = $crawler->selectButton('Eliminar')->form();

        // Envío el formulario de eliminacion
        $crawler = $client->submit($formulario);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testFichaAction() {
        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/ficha/'. ConstantesTests::CARRERA_PROFESORADO_DE_PRIMARIA);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('html:contains("Estado")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Normas")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("dicta")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("cuadro")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("plan")')->count() > 0);
    }

    public function do_asignarAction(Request $request) {
        
    }

    public function testAsignar_establecimientoAction() {

        $carrera = $this->manager
                ->getEm()
                ->getRepository('OfertaEducativaBundle:Carrera')
                ->findOneBy(
                array(
                    'id' => ConstantesTests::CARRERA_PROFESORADO_DE_PRIMARIA,
        ));

        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/asignar_establecimiento/' . $carrera->getId());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('html:contains("dictando")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Volver a la ficha")')->count() > 0);
    }

//    private function getEstablecimientosForms($carrera) {
//    private function crearAsignarForm($establecimiento, $carrera, $nro_form) {

    /**
     * DEPRECATED
     * @param type $carrera_id
     */
//    public function testNomina_donde_se_dictaAction($carrera_id = 1) {
//        $client = $this->client;
//
//        $crawler = $client->request('GET', '/oferta/carrera/nomina_donde_se_dicta/' . $carrera_id);
//
//        $this->assertTrue(200 == $client->getResponse()->getStatusCode());
//    }

    public function testNominaAction() {
        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/nomina');
        $this->assertTrue(200 == $client->getResponse()->getStatusCode());

        $link = $crawler->filter('a:contains("Siguiente")')->last()->link();

        //hace click en el link
        $crawler = $client->click($link);
        $this->assertTrue(200 == $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('html:contains("Volver")')->count() > 0);
    }

    /**
     * DEPRECATED
     * 
     * @dataProvider provideUrls 
     * 
     * Vale por:
     * nomina_resumida
     * nomina_resumida_donde_se_dicta
     * indicadores_cohorte
     * indicadores_cohorte_estalecimiento/13
     * indicadores_cohorte_unidad_oferta/10
     */
//    public function testPageIsSuccessful($url) {
//        $client = $this->client;
//        $client->request('GET', $url);
//        $this->assertTrue($client->getResponse()->isSuccessful());
//        $this->assertTrue(200 == $client->getResponse()->getStatusCode());
//    }

    /**
     * @return type
     */
    public function provideUrls() {
        $x = '/oferta/carrera';
        return array(
//            array($x . '/nomina_resumida'),                           //DEPRECATED
//            array($x . '/nomina_resumida_donde_se_dicta/1'),            //Llama a una plantilla que fue modificada
//            array($x . '/nomina_resumida_planilla_de_calculo'), NO ANDA. COPIAR de ACTO PUBLICO
//            array($x . '/indicadores_cohorte'),
//            array($x . '/indicadores_cohorte_estalecimiento/13'),
//            array($x . '/indicadores_cohorte_unidad_oferta/10'),
        );
    }

    /**
     * @dataProvider otraTandas 
     * 
     * DEPRECATED
     * 
     * vale por:
     * /indicadores_cohorte_estalecimiento/13
     * /indicadores_cohorte_unidad_oferta/10
     * /cuadro_matricula/1
     * /tarjeta_carrera/1
     */
//    public function testOtraTandaDePaginas($otraTanda) {
//        $client = $this->client;
//        $client->request('GET', $otraTanda);
//        $this->assertTrue($client->getResponse()->isSuccessful());
//    }
    /**
     * 
     * @return type
     */
    public function otraTandas() {
        $x = '/oferta/carrera';
        return array(
//            array($x . '/indicadores_cohorte'), NO SE PUEDE TESTEAR POR QUE SOBREPASA LAS 100 LLAMADAS ANIDADAS
//            array($x . '/indicadores_cohorte_establecimiento/13'),            //fue modificado y hay que revisar
            array($x . '/indicadores_cohorte_unidad_oferta/10'),
            array($x . '/cuadro_matricula/1'),
            array($x . '/tarjeta_carrera/1'),
        );
    }
    /**
     * Se usa la norma_id 10 que es la Nro 609
     * 
     * @param type $carrera_id
     * @param type $norma_id
     */
    public function testVincularNormaAction($norma_id = 10) {
                
        $client = $this->client;
        $crawler= $client->request('GET', '/oferta/carrera/norma_vincular_carrera/'. 
                ConstantesTests::CARRERA_PROFESORADO_DE_PRIMARIA . 
                '/' . 
                ConstantesTests::NORMA_PROFESORADO_DE_PRIMARIA);
        
        $this->assertTrue($client->getResponse()->isSuccessful());
        
        $this->assertTrue($crawler->filter('td:contains("2514")')->count() > 0);
    }
    /**
     * Desvincula la vinculada en el test anterior
     * 
     * @param type $carrera_id
     * @param type $norma_id
     */
    public function testDesvincularNormaAction($norma_id= 10) {
        $client = $this->client;
                
        $crawler= $client->request('GET', 
                '/oferta/carrera/desvincular_norma/'. 
                ConstantesTests::CARRERA_PROFESORADO_DE_PRIMARIA . 
                '/' . 
                ConstantesTests::NORMA_PROFESORADO_DE_PRIMARIA);
        $this->assertTrue($client->getResponse()->isSuccessful());
        
        $this->assertTrue($crawler->filter('td:contains("609")')->count() == 0);
    }
}
