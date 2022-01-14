<?php

namespace App\Tests\Unitarios\Infrastructure\Api;

use App\Infrastructure\Persistence\InFileSystemPersistence;
use PHPUnit\Framework\TestCase;

class SystemPersistenceTest extends TestCase
{
    /** @test */
    public function loadDataTest(): void
    {
        $repository = InFileSystemPersistence::getRepository();
        $this->assertTrue(count($repository->getAds()) > 0 AND count($repository->getPictures()) > 0 );
    }
}
