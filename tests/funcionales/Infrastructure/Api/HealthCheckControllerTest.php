<?php

namespace App\Tests\Funcionales\Infrastructure\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckControllerTest extends WebTestCase
{

    /** @test */
    public function HealthCheckTest(): void
    {
        $client = static::createClient();
        $client->request('GET', '/health');

        $this->assertResponseIsSuccessful();
    }
}
