<?php

namespace Fd\OfertaEducativaBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Controller\CarreraController;

/**
 * testea el crud de establecimiento del backend
 */
class CarreraControllerTest extends LoginWebTestCase {

    const ACTIVA = 1;

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

//    private function getEm() {
//    private function getRepo() {

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
        //son 2 activas y un titulo
        $this->assertEquals(3, $crawler->filter('tr')->count()
        );

        $this->assertEquals($crawler->filter('td:contains("Activa")')->count(), $crawler->filter('tr')->count() - 1);
    }

    public function filtros() {
        return array(
            array(
                array(
                    'carrera_filter[estado]' => self::ACTIVA,
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
                    'carrera_type[estado]' => 1,
                    'carrera_type[anio_inicio]' => 2015,
                )
            )
        );
    }

    /**
     * @dataProvider filtros
     */
    public function testEliminarAction($filtro) {
        $client = $this->client;

        $crawler = $client->request('GET', '/oferta/carrera/buscar');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $formulario = $crawler->selectButton('Buscar')->form($filtro);

        //realiza una busqueda con estado ACTIVA
        $crawler = $client->submit($formulario);

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

        $crawler = $client->request('GET', '/oferta/carrera/editar/1');
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

//    public function fichaAction($carrera) {
//    public function do_asignarAction(Request $request) {
//    public function asignar_establecimientoAction(Carrera $carrera, Request $request) {
//    private function getEstablecimientosForms($carrera) {
//    private function crearAsignarForm($establecimiento, $carrera, $nro_form) {
////    public function donde_se_dictaAction($carrera_id) {
//    public function nomina_donde_se_dictaAction($carrera_id) {
//    public function nominaAction() {
//    public function nomina_resumidaAction() {
//    public function nomina_resumida_donde_se_dictaAction(Carrera $carrera) {
//    public function nomina_resumida_planilla_de_calculoAction() {
//    public function historia_estado_validezAction(Request $request, $id) {
//    public function indicadores_cohorteAction() {
//    public function indicadores_cohorte_establecimientoAction($establecimiento_id) {
//    public function indicadores_cohorte_unidad_ofertaAction($unidad_oferta_id) {
//    public function resumen_validezAction() {
//    public function resumen_validez_establecimientoAction($establecimiento_id) {
//    public function resumen_validez_carreraAction($carrera, $clase_css) {
//    public function cuadro_matriculaAction($carrera) {
//        $ordenar = function ($elemento1, $elemento2) {
//    public function tarjeta_carreraAction($carrera_id) {
//    public function desvincularNormaAction($carrera, $norma) {
//    public function vincularNormaAction($carrera, $norma) {
}
