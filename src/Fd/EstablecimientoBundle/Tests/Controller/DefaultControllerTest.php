<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    public function testPortada() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Accedé con tu usuario")')->count() > 0);
    }

    public function testContacto() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contacto');

        $this->assertTrue($crawler->filter('html:contains("Conmutador")')->count() > 0);
    }

    public function testEnDesarrollo() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en_desarrollo');

        $this->assertTrue($crawler->filter('html:contains("Página en desarrollo")')->count() == 0);
    }

    public function testAgenda() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agenda');

        $this->assertTrue($crawler->filter('html:contains("Agenda de la DFD")')->count() == 0);
    }

    public function testGlosario() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/glosario');

        $this->assertTrue($crawler->filter('html:contains("Desgranamiento")')->count() == 0);
    }

    public function testAcercaDe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/acerca_de');

        $this->assertTrue($crawler->filter('html:contains("Sistema de Información de la Dirección de Formación Docente")')->count() == 0); 
            
    }
}
    