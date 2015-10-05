<?php

namespace Fd\BackendBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\BackendBundle\Form\OfertaEducativaType;
use Fd\EstablecimientoBundle\Model\ConstantesTests;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
/**
 * testea el crud de oferta educativa del backend
 * 
 * FALTA testear create, update, delete
 * 
 */
class OfertaEducativaControllerTest extends WebTestCase {

    private $client = null;
    private $crawler = null;

    public function setUp() {
        $this->client = static::createClient();
        $this->client->followRedirects(true);

        $this->crawler = $this->client->request('GET', '/usuario/login');
        $form = $this->crawler->selectButton('Remitir')->form();
        $form['_username'] = 'marcelo';
        $form['_password'] = '888';
        $this->crawler = $this->client->submit($form);
    }

    /** @dataProvider provideUrls */
    public function testPageIsSuccessful($url) {
        $client = $this->client;
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @return type
     */
    public function provideUrls() {
        return array(
            array('/backend/ofertaeducativa/'),
            array('/backend/ofertaeducativa/' . ConstantesTests::OFERTA_CIENCIA_JURIDICA . '/show'),
            array('/backend/ofertaeducativa/new'),
            array('/backend/ofertaeducativa/' . ConstantesTests::OFERTA_CIENCIA_JURIDICA . '/edit'),
// ...
        );
    }

    /**
     * @dataProvider establecimientos
     * 
     * @param type $establecimiento 
     */
//    public function testCompleteScenario($establecimiento) {
//        $client = $this->client;
//        $crawler = $this->crawler;
//
//        // Llama a la página del index
//        $crawler = $client->request('GET', '/backend/establecimiento');
//        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
//
//        /**
//         * Creación de nuevo establecimiento 
//         */
//        // Hace click en el link a la página de nuevo establecimiento
//        $crawler = $client->click($crawler->selectLink('Crear nuevo registro')->link());
//
//        // Verifica que se visualizò la pagina de edicion
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Crear registro de Establecimiento")')->count(), 'Se visualiza la página de creación de establecimiento');
//
//        // Selecciono el formulario de la página y lo lleno con el dataProvider
//        $formulario = $crawler->selectButton('Crear')->form($establecimiento);
//
//        // Envío el formulario con datos de alta
//        $crawler = $client->submit($formulario);
//        $this->assertTrue($client->getResponse()->isSuccessful());
//
//        // Check que se grabó ok
//        $this->assertEquals(
//                $establecimiento['fd_establecimientobundle_establecimientotype[apodo]'],
//                $crawler->filter('form input[name="fd_establecimientobundle_establecimientotype[apodo]"]')->attr('value'), 'El establecimiento se registró ok'
//        );
//        
//        /**
//         *  Prueba de modificación de un dato y grabación de lo editado
//         */
//        // Cambio un dato editado
//        $establecimiento['fd_establecimientobundle_establecimientotype[descripcion]'] = 'modificado test';
//
//        // Selecciono el formulario de la página y lo lleno con el dataProvider modificado
//        $formulario = $crawler->selectButton('Guardar')->form($establecimiento);
//
//        // Envío el formulario con datos de alta
//        $crawler = $client->submit($formulario);
//        $this->assertTrue($client->getResponse()->isSuccessful());
//        // Check que se grabó ok
//        $this->assertEquals(
//                $establecimiento['fd_establecimientobundle_establecimientotype[descripcion]'], 
//                $crawler->filter('form input[name="fd_establecimientobundle_establecimientotype[descripcion]"]')->attr('value'), 
//                'El establecimiento se registró ok por segunda vez'
//        );
//
//        /**
//         * Prueba de eliminación del dato reción creado 
//         */
//        // Se llama al formulario de eliminación con el id como dato del form
//
//        $crawler = $client->submit($crawler->selectButton('Eliminar')->form());
//        $this->assertTrue($client->getResponse()->isSuccessful());
//
//        // Se verifica que sea la página de index
////                'Volvió a index');
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Lista de Establecimiento")')->count(), 'Volvió a index')
//        ;
//
//        // Se verifica que no aparezca la dirección en la lista de la página de index
//        $this->assertEquals(0, $crawler->filter('html:contains("modificado test")')->count(), 'Se eliminó. No figura en la lista.');
//    }
//    public function establecimientos() {
//        return array(
//            array(
//                array(
//                    'fd_establecimientobundle_establecimientotype[cue]' => '256325',
//                    'fd_establecimientobundle_establecimientotype[nombre]' => 'este de aca',
//                    'fd_establecimientobundle_establecimientotype[apodo]' => 'CUEC',
//                    'fd_establecimientobundle_establecimientotype[orden]' => 75,
//                    'fd_establecimientobundle_establecimientotype[descripcion]' => 'creado para el test',
//                    'fd_establecimientobundle_establecimientotype[descripcion]' => 'creado para el test',
//                    'fd_establecimientobundle_establecimientotype[tiene_cooperadora]' => 'no',
//                )
//            )
//        );
//    }
}
