<?php

namespace Fd\EdificioBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

class VecinoControllerTest extends LoginWebTestCase {

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
        $x = '/backend/vecino';
        return array(
            array($x . '/'),
            array($x . '/1/show'),
            array($x . '/new'),
            array($x . '/1/edit'),
// ...
        );
    }

    /*
      public function testCompleteScenario()
      {
      // Create a new client to browse the application
      $client = static::createClient();

      // Create a new entry in the database
      $crawler = $client->request('GET', '/vecino/');
      $this->assertTrue(200 === $client->getResponse()->getStatusCode());
      $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

      // Fill in the form and submit it
      $form = $crawler->selectButton('Create')->form(array(
      'fd_edificiobundle_vecinotype[field_name]'  => 'Test',
      // ... other fields to fill
      ));

      $client->submit($form);
      $crawler = $client->followRedirect();

      // Check data in the show view
      $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

      // Edit the entity
      $crawler = $client->click($crawler->selectLink('Edit')->link());

      $form = $crawler->selectButton('Edit')->form(array(
      'fd_edificiobundle_vecinotype[field_name]'  => 'Foo',
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
