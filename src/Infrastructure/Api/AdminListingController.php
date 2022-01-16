<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Controller\Utils;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\MensajeScore;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminListingController
{

     /**
     * @Route("/listingAdAdmin", name="listing_ad_admin")
     */
    public function __invoke(): JsonResponse
    {
        $repository = InFileSystemPersistence::getRepository();
        $utils = new Utils();

        //PROBLEMA DE GESTIONAR LOS DATOS EN MEMORIA (En un entorno real los datos estarían actualizados en Base de datos)
        //Por tanto con esto simulamos que recuperamos los datos de la respectiva Base de datos
        // con la puntuación de los anuncios que previamente se han debido de asignar por el gestor de calidad
        $controller = new CalculateScoreController();   
        $controller->Auxscore();

       
        if($utils->isAdmin()){
            $response = new JsonResponse();
            $content = [];
            $ads = $repository->getAds();
            foreach($ads as $ad){
                $content[] = $utils->serializeAd($ad);
            }
            $response->setData($content);
            return $response;
        }

        return new JsonResponse(MensajeScore::UNAUTHORIZED,Response::HTTP_UNAUTHORIZED);

    }
}
