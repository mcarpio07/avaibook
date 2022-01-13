<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CalculateScoreController
{
    /**
     * @Route("/calculateScore", name="calculate_score")
     */
    public function __invoke(): JsonResponse
    {
        $repository = InFileSystemPersistence::getRepository();
        //dump($repository->getAds());

        return new JsonResponse([]);
    }

    
}
