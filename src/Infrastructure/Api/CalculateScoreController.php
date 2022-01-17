<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Controller\Utils;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\MensajeScore;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CalculateScoreController
{
    /**
     * @Route("/calculateScore", name="calculate_score")
     */
    public function __invoke(): Response
    {
        $repository = InFileSystemPersistence::getRepository();
        $utils = new Utils();
        if($utils->isAdmin()){
            $ads = $repository->getAds();
            foreach($ads as $ad){
                $ad->calculateScore();
            }
            $repository->setAds($ads);
            $utils->orderAd();
            return new Response(MensajeScore::OK,Response::HTTP_ACCEPTED);
            
        }else{
            return new Response(MensajeScore::UNAUTHORIZED,Response::HTTP_UNAUTHORIZED);
        }
        
    }


    /**
     * Función creada para solventar el problema de gestionar los datos en memoria y no en una BBDD y simular que la puntuación se ha asignado
     */
    public function Auxscore(){
        $repository = InFileSystemPersistence::getRepository();
        $utils = new Utils();
        $ads = $repository->getAds();
        foreach($ads as $ad) $ad->calculateScore();
        $utils->orderAd();

    }


    
}
