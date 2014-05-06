<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LocalizacionControllerTest extends WebTestCase {

    private $client = null;
    private $crawler = null;

    public function setUp() {
        $this->client = static::createClient();
        
        $this->crawler = $this->client->request('GET', '/');
        $form = $this->crawler->selectButton('Remitir')->form();
        $form['_username'] = 'marcelo';
        $form['_password'] = '1234';
        $this->crawler = $this->client->submit($form);

    }

    /**
     * testea el index con logueo de usuario
     * 
     * Hace aserciones de más. Sirven de modelo
     */
    public function testIndex() {

        // si la URL no termina en '/', en este caso la redirecciona y hay que chequear que redirija 
        $this->crawler = $this->client->request('GET', '/backend/localizacion/');
//        $this->crawler= $this->client->followRedirect();
        
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertGreaterThan(0, $this->crawler->filter('html:contains("Lista de localizaciones")')->count());

//        $this->assertRegExp('/Lista de localizaciones/', $this->client->getResponse()->getContent());
//        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
    public function testNew(){
        $this->crawler = $this->client->request('GET', '/backend/localizacion/new');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $this->crawler->filter('html:contains("Crear registro de Localizacion")')->count());
    }

//    public function testEdit(){
//        $client = static::createClient();
//        
//        $crawler = $client->request('GET', '/backend/localizacion/36/edit');
//        
//        $this->assertTrue($crawler->filter('html:contains("Nivel o unidad educativa del establecimiento")')->count() > 0);
//        
//    }
     
//        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());
//
//        // Fill in the form and submit it
//        $form = $crawler->selectButton('Create')->form(array(
//            'localizacion[field_name]'  => 'Test',
//            // ... other fields to fill
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//
//        // Check data in the show view
//        $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);
//
//        // Edit the entity
//        $crawler = $client->click($crawler->selectLink('Edit')->link());
//
//        $form = $crawler->selectButton('Edit')->form(array(
//            'localizacion[field_name]'  => 'Foo',
//            // ... other fields to fill
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//
//        // Check the element contains an attribute with value equals "Foo"
//        $this->assertTrue($crawler->filter('[value="Foo"]')->count() > 0);
//
//        // Delete the entity
//        $client->submit($crawler->selectButton('Delete')->form());
//        $crawler = $client->followRedirect();
//
//        // Check the entity has been delete on the list
}
//        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());