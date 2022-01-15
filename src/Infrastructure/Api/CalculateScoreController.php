<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Controller\Utils;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\Rol;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

final class CalculateScoreController
{
    /**
     * @Route("/calculateScore", name="calculate_score")
     */
    public function __invoke(): JsonResponse
    {
        $repository = InFileSystemPersistence::getRepository();
        $utils = new Utils();
        if($utils->isAdmin()){
            $ads = $repository->getAds();
            foreach($ads as $ad){
                $ad->calculateScore();
            }
            return new JsonResponse([],201);
        }else{
            $ads = $repository->getAds();
            foreach($ads as $ad){
                $ad->calculateScore();
            }

            dump($ads);
            return new JsonResponse([],403);
        }
        //dump($repository->getUsers());

        
    }

    
}
