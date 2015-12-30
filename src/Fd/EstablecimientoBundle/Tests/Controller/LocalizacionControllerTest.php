<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LocalizacionControllerTest extends LoginWebTestCase {

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

    public function testListado_matricula_localizacionAction() {
        $client = $this->client;

        $client->request('GET', '/establecimiento/localizacion/matricula_de_localizacion');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
}
    