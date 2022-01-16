<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Controller\Utils;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class UserListingController
{

    
    /**
     * @Route("/listingAdUser", name="listing_ad_user")
     */
    public function __invoke(): JsonResponse
    {
        $repository = InFileSystemPersistence::getRepository();

        //PROBLEMA DE GESTIONAR LOS DATOS EN MEMORIA (En un entorno real los datos estarían actualizados en Base de datos)
        //Por tanto con esto simulamos que recuperamos los datos de la respectiva Base de datos
        // con la puntuación de los anuncios que previamente se han debido de asignar por el gestor de calidad
        $controller = new CalculateScoreController();   
        $controller->Auxscore();

        $utils = new Utils();
        $response = new JsonResponse();
        $content = [];
        $ads = $repository->getAds();
        $utils->orderAd();
        foreach($ads as $ad){
            if($ad->isRelevant()) $content[] = $utils->serializeAd($ad);
        }

        $response->setData($content);

        return $response;
    }
}
