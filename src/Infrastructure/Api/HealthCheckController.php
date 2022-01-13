<?php

namespace App\Infrastructure\Api;

use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    /**
     * @Route("/health", name="health_check")
     */
    public function __invoke(): Response
    {
        return new Response(); //Devuelve un código 200
    }
}
