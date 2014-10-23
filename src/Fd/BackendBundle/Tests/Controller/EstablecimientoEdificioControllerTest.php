<?php

namespace Sga\BackendBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

/**
 * crud del backend de establecimiento_edificio.
 * FALTA Tiene un ajax que no se está testeando
 * FALTA create, update, delete y createdelete
 */

class EstablecimientoEdificioControllerTest extends LoginWebTestCase {

    public function testListar() {
        // Create a new client to browse the application
        $client = $this->client;

        // request de pagina busqueda de sede/anexos
        $crawler = $client->request('GET', '/backend/establecimiento_edificio');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Crear nueva sede/anexo")')->count());
        return;
        //hace click en la accion de creación
        $crawler = $client->click($crawler->selectLink('Crear nueva sede')->link());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        //verifica que fue a la página de edición
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Crear registro de EstablecimientoEdificio")')->count());
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
        $x = '/backend/establecimiento_edificio';
        return array(
            array($x . '/'),
            array($x . '/16/show'),
            array($x . '/new'),
            array($x . '/16/edit'),
// ...
        );
    }

    /*
      public function testCompleteScenario()
      {
      // Create a new client to browse the application
      $client = static::createClient();

      // Create a new entry in the database
      $crawler = $client->request('GET', '/backend/establecimiento_edificio/');
      $this->assertTrue(200 === $client->getResponse()->getStatusCode());
      $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

      // Fill in the form and submit it
      $form = $crawler->selectButton('Create')->form(array(
      'establecimientoedificio[field_name]'  => 'Test',
      // ... other fields to fill
      ));

      $client->submit($form);
      $crawler = $client->followRedirect();

      // Check data in the show view
      $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

      // Edit the entity
      $crawler = $client->click($crawler->selectLink('Edit')->link());

      $form = $crawler->selectButton('Edit')->form(array(
      'establecimientoedificio[field_name]'  => 'Foo',
      // ... other fields to fill
      ));

      $client->submit($form);
      $crawler = $client->followRedirect();

      // Check the element contains an attribute with value equals "Foo"
      $this->assertTrue($crawler->filter('[value="Foo"]')->count() > 0);

      // Delete the entity
      $client->submit($crawler->selectButton('Delete')->form());
      $crawler = $client->followRedirect();

      // Check the entity has been delete on the list
      $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
      }
     */
}
