<?php

namespace App\Tests\Unitarios\Infrastructure\Api;

use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\Rol;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function noLoginTest(): void
    {
        $repository = InFileSystemPersistence::getRepository();
        $user = $repository->login('abcd','abcd');
        $this->assertEquals($user,null);
    }

    /** @test */
    public function LoginTest(): void
    {
        $repository = InFileSystemPersistence::getRepository();
        $user = $repository->login('root','root');
        $this->assertEquals(gettype($user),"object");
    }

}
