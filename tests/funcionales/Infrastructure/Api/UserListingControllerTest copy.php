<?php

namespace App\Tests\Funcionales\Infrastructure\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserListingControllerTest extends WebTestCase
{

    /** @test */
    public function listingAdUserTest(): void
    {
        $client = static::createClient();
        
        //Login como admin
        $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"root",
              "password" :"root"}'
        );

        //Asigno puntuacion a los anuncios
        $client->request('GET', '/calculateScore');


        //Login como user
        $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"user1",
              "password" :"user1"}'
        );

        //Listado como user
        $client->request('GET', '/listingAdUser');

        $this->assertNotEmpty($client->getResponse()->getContent());
    }
}
