<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

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

    public function testAvisos() {

        $client = $this->client;
        $crawler = $this->crawler;

        // Llama a la página del index
        $crawler = $client->request('GET', '/establecimiento/avisos');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Continuar")')->count(), 'Se visualiza la página de avisos');
    }

    public function testContacto() {

        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/contacto');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Conmutador")')->count(), 'Se visualiza la página de contacto');
    }

    public function testAvances_del_sistema() {
        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/avances_del_sistema');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('html:contains("requerido 7-3-2014")')->count() > 0);        
    }

    public function testEnDesarrollo() {

        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/en_desarrollo');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('html:contains("Página en desarrollo")')->count() > 0);
    }

    public function testAgenda() {

        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/agenda');

        $this->assertTrue($crawler->filter('html:contains("Agenda de la DFD")')->count() > 0);
    }

    public function testGlosario() {

        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/glosario');

        $this->assertTrue($crawler->filter('html:contains("Desgranamiento")')->count() > 0);
    }

    public function testAcercaDe() {

        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/acerca_de');

        $this->assertTrue($crawler->filter('html:contains("Sistema de Información de la Dirección de Formación Docente")')->count() > 0);
    }

    public function testCumpleanios() {

        $client = $this->client;
        $crawler = $this->crawler;

        $crawler = $client->request('GET', '/establecimiento/cumpleanios');

        $this->assertTrue($crawler->filter('html:contains("Prizmic")')->count() > 0);
    }

}
