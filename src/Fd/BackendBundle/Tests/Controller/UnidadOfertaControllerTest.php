<?php

namespace Fd\BackendBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

/**
 * testea el crud de autoridad que tiene una busqueda en el index
 * 
 * FALTA create, update, delete, deleteForm, generarDatosBusquedaPaginada
 */
class UnidadOfertaControllerTest extends LoginWebTestCase {
//
//    public function testBuscar() {
//        // Create a new client to browse the application
//        $client = $this->client;
//
//        // buscar una autoridad
//        $crawler = $client->request('GET', '/backend/autoridad/buscar');
//        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
//
//        //cliqueo en buscar
//        $form = $crawler->selectButton('Buscar')->form();
//        $crawler = $client->submit($form);
//
//        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
//
//        $this->assertGreaterThan(0, $crawler->filter('th:contains("Acciones")')->count()
//        );
//
//        //hace click en la acción editar
//        $crawler = $client->click($crawler->selectLink('Editar')->link());
//        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
//
//        //verifica que fue a la página de edición
//        $this->assertgreaterThan(0, $crawler->filter('h1:contains("Editar Autoridad")')->count());
//    }
//
//    /** @dataProvider provideUrls */
//    public function testPageIsSuccessful($url) {
//        $client = $this->client;
//        $client->request('GET', $url);
//        $this->assertTrue($client->getResponse()->isSuccessful());
//    }
//
//    /**
//     * @return type
//     */
//    public function provideUrls() {
//        $x = '/backend/autoridad';
//        return array(
//            array($x . '/buscar'),
//            array($x . '/1/show'),
//            array($x . '/new'),
//            array($x . '/1/edit'),
//// ...
//        );
//    }
=======

    const TER_JOAQUIN = 109;
    const OFERTA_PNP = 13;
    const JOAQUIN_INGLES = 89;

    public $repository;

    public function setUp() {
        parent::setup();

        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->repository = static::$kernel->getContainer()
                ->get('doctrine.orm.entity_manager')
                ->getRepository('EstablecimientoBundle:UnidadOferta');
    }

    public function testIndexAction() {
        $client = $this->client;
        $client->request('GET', '/backend/unidadoferta');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testListarAction($unidad_educativa_id = self::TER_JOAQUIN) {
        $client = $this->client;
        $client->request('GET', '/backend/unidadoferta/listar/' . $unidad_educativa_id);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testComboAction($unidad_educativa_id = self::TER_JOAQUIN) {
        $client = $this->client;
        $crawler = $client->request('GET', '/backend/unidadoferta/combo/' . $unidad_educativa_id);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $expresion = $crawler->filter('option')->last()->text();

        $this->assertRegExp('/Joaqu/', $client->getResponse()->getContent());
    }

    /**
     * @dataProvider unidad_ofertas
     */
    public function testCrearEditarBorrarAction($unidad_oferta) {
        $client = $this->client;
        $crawler = $client->request('GET', '/backend/unidadoferta/new');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $cantidad_original = $this->repository->findAll();

        //generao una nueva carrera en el joaquin
        $form = $crawler->selectButton('Crear')->form($unidad_oferta);
        $crawler = $client->submit($form);

        //se grabo ok
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        //fue a la pagina de edicion
        $this->assertTrue($crawler->filter('html:contains("Editar UnidadOferta")')->count() > 0);

        //se grabo uno mas
        $cantidad_nueva = $this->repository->findAll();

        //verifica que hay uno mas
        $this->assertTrue($cantidad_original !== $cantidad_nueva);

        //se borra el nuevo. Selecciona el boton de borrado
        $form = $crawler->selectButton('Eliminar')->form();
        
        //despache el formulario de borrado
        $crawler = $client->submit($form);
        
        //elimino ok
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        
        //verifica que hay tantos como al principio
        $cantidad_nueva = $this->repository->findAll();
        $this->assertTrue($cantidad_original == $cantidad_nueva);
    }

    public function unidad_ofertas() {
        return array(
            array(
                array(
                    'fd_establecimientobundle_unidadofertatype[unidades]' => self::TER_JOAQUIN,
                    'fd_establecimientobundle_unidadofertatype[ofertas]' => self::OFERTA_PNP,
                )
            )
        );
    }

    public function updateAction($unidad_oferta_id = self::JOAQUIN_INGLES) {
        $client = $this->client;
        
        //muestra pagina edicion
        $crawler = $client->request('GET', '/backend/unidadoferta/'. $unidad_oferta_id . '/edit');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());        
        
        //guarda sin modificar nada
        $form = $crawler->selecButton('Guardar')->form();
        $crawler = $client->submit($form);
        
        $this->assertTrue( $crawler->filter('a:contains("Agregar un turno")')->count() > 0 );
    }
>>>>>>> b95f24bec1af72ee20ceb5a147074f9fcea685db

}
