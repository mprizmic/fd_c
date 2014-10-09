<?php

namespace Fd\EdificioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * testea el crud de domicilio del backend
 */
class DomicilioControllerTest extends WebTestCase {

    private $client = null;
    private $crawler = null;

    public function setUp() {
        $this->client = static::createClient();
        $this->client->followRedirects(true);

        $this->crawler = $this->client->request('GET', '/');
        $form = $this->crawler->selectButton('Remitir')->form();
        $form['_username'] = 'marcelo';
        $form['_password'] = '1234';
        $this->crawler = $this->client->submit($form);
    }

    /**
     * @dataProvider domicilios
     * 
     * @param type $domicilio 
     */
    public function testCompleteScenario($domicilio) {
        $client = $this->client;
        $crawler = $this->crawler;

        // Llama a la página del index
        $crawler = $client->request('GET', '/backend/domicilio');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        /**
         * Creación de nuevo domicilio 
         */
        // Hace click en el link a la página de nuevo domicilio
        $crawler = $client->click($crawler->selectLink('Crear nuevo registro')->link());

        // Verifica que se visualizò la pagina de edicion
        $this->assertGreaterThan(0, 
                $crawler->filter('html:contains("Crear registro de Domicilio ")')->count(),
                'Se visualiza la página de creación de domicilio');

        // Selecciono el formulario de la página y lo lleno con el dataProvider
        $formulario = $crawler->selectButton('Crear')->form($domicilio);

        // Envío el formulario con datos de alta
        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        // Check que se grabó ok
        $this->assertEquals(
                $domicilio['fd_edificiobundle_domiciliotype[calle]'],
                $crawler->filter('form input[name="fd_edificiobundle_domiciliotype[calle]"]')->attr('value'),
                'El domicilio se registró ok'
        );

        /**
         *  Prueba de modificación de un dato y grabación de lo editado
         */
        // Cambio un dato editado
        $domicilio['fd_edificiobundle_domiciliotype[calle]'] = 'modificado por el test';

        // Selecciono el formulario de la página y lo lleno con el dataProvider modificado
        $formulario = $crawler->selectButton('Guardar')->form($domicilio);

        // Envío el formulario con datos de alta
        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        // Check que se grabó ok
        $this->assertEquals(
                $domicilio['fd_edificiobundle_domiciliotype[calle]'],
                $crawler->filter('form input[name="fd_edificiobundle_domiciliotype[calle]"]')->attr('value'),
                'El domicilio se registró ok por segunda vez'
        );

        /**
         * Prueba de eliminación del dato reción creado 
         */
        // Se llama al formulario de eliminación con el id como dato del form

        $crawler = $client->submit($crawler->selectButton('Eliminar')->form());
        $this->assertTrue($client->getResponse()->isSuccessful());
        
        // Se verifica que sea la página de index
//                'Volvió a index');
        $this->assertGreaterThan(0, 
                $crawler->filter('html:contains("Lista de Domicilio")')->count(),
                'Volvió a index')
                ;        
        
        // Se verifica que no aparezca la dirección en la lista de la página de index
        $this->assertEquals(0,
                $crawler->filter('html:contains("modificado por el test")')->count(),
                'Se eliminó. No figura en la lista.');
    }

    public function domicilios() {
        return array(
            array(
                array(
                    'fd_edificiobundle_domiciliotype[calle]' => 'sarasa',
                    'fd_edificiobundle_domiciliotype[altura]' => '123',
                    'fd_edificiobundle_domiciliotype[c_postal]' => '456',
                    'fd_edificiobundle_domiciliotype[principal]' => false,
                    'fd_edificiobundle_domiciliotype[edificio]' => 20,
                )
            )
        );
    }

}