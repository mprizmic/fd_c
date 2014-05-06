<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EstablecimientoControllerTest extends WebTestCase {

    public function testDamero() {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento/damero');

        $this->assertTrue($crawler->filter('html:contains("Bienvenido al Sistema de la Dirección de Formación Docente!")')->count() == 0);
    }

    public function testEstablecimientoDeUnCui() {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento_de_un_cui/21');

        $this->assertTrue($crawler->filter('html:contains("Escuela Normal Superior Nro 8 Julio Argentino Roca")')->count() == 0);
    }
    public function testTarjetaEstablecimiento() {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/tarjeta_establecimiento/21');

        $this->assertTrue($crawler->filter('html:contains("Escuela Normal Superior Nro 8 Julio Argentino Roca")')->count() == 0);
    }
    public function testCuadroMatricula() {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/establecimiento/cuadro_matricula/14/carrera');

        $this->assertTrue($crawler->filter('html:contains("Cuadro de matrícula por carreras")')->count() == 0);
    }
    //establecimiento_de_un_cue
    //
    //Escuela Normal Superior Nro 8 Julio Argentino Roca
    //
    //
    //ficha
    //nuevoNroAnexo
}