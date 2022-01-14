<?php

namespace App\Tests\Funcionales\Infrastructure\Api;

use App\Infrastructure\Persistence\Rol;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SignInControllerTest extends WebTestCase
{

    /** @test */
    public function loginTest(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"root",
              "password" :"root"}'
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_ACCEPTED);
    }

    /** @test */
    public function loginAdminTest(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"root",
              "password" :"root"}'
        );

        $this->assertEquals($client->getResponse()->getContent(),Rol::Admin);
    }

    /** @test */
    public function loginUserTest(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"user1",
              "password" :"user1"}'
        );

        $this->assertEquals($client->getResponse()->getContent(),Rol::User);
    }

    /** @test */
    public function loginErrorTest(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"usuario",
              "password" :"usuario"}'
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    
}
