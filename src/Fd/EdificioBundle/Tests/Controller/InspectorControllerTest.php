<?php

namespace Fd\EdificioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InspectorControllerTest extends WebTestCase {

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


    public function testListado_inspectoresAction() {
        $client = $this->client;

        $client->request('GET', '/edificio/inspector/listado_inspectores');
        
        $this->assertTrue($client->getResponse()->isSuccessful());
        
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

    }

}
