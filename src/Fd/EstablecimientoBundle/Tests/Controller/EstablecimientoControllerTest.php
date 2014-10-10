<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EstablecimientoControllerTest extends WebTestCase {

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

    public function testDocentesNivelListado() {
        $client = $this->client;
        $crawler = $this->crawler;

        // Llama a la página del index
        $crawler = $client->request('GET', '/establecimiento/docentes_nivel_listado');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        // Verifica que se visualizò la pagina de edicion
        $this->assertGreaterThan(0, $crawler
                        ->filter('html:contains("Dickens")')
                        ->count(), 'Se visualiza la página de creación de establecimiento');
    }

    public function testCuadroMatricula() {

        // llamada al recurso
        $this->crawler = $this->client->request('GET', '/establecimiento/cuadro_matricula/14/carrera');
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $this->crawler
                        ->filter('html:contains("Graduados")')
                        ->count(), 'se visualiza la página de matrícula'
        );
    }

    public function testDamero() {
        $client = $this->client;
        $crawler = $this->crawler;

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento/damero');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('html:contains("Bienvenido al Sistema de la Dirección de Formación Docente!")')->count() > 0);
    }

    public function testEstablecimientoDeUnCui() {

        $client = $this->client;
        $crawler = $this->crawler;

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento/establecimiento_de_un_cui/21');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
                0, $crawler
                        ->filter('html:contains("Distrito escolar:")')
                        ->count());
    }

    public function testFicha() {
        $client = $this->client;
        $crawler = $this->crawler;

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento/ficha/13');
        
        
        
        
        
        
        
        
        
        HASTA aca
    }

    public function testNomina() {
        
    }

    public function testNuevoNroAnexo() {
        
    }

    public function testTarjetaEstablecimiento() {
        $client = $this->client;
        $crawler = $this->crawler;

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento/tarjeta_establecimiento/21');

        $this->assertGreaterThan(0, $crawler
                        ->filter('html:contains("CUE:")')
                        ->count()
        );
    }

}
