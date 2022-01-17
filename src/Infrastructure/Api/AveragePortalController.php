<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Controller\Utils;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\MensajeScore;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AveragePortalController
{

     /**
     * @Route("/averagePortal", name="average_portal")
     */
    public function __invoke(): JsonResponse
    {
        $utils = new Utils();

        //PROBLEMA DE GESTIONAR LOS DATOS EN MEMORIA (En un entorno real los datos estarían actualizados en Base de datos)
        //Por tanto con esto simulamos que recuperamos los datos de la respectiva Base de datos
        // con la puntuación de los anuncios que previamente se han debido de asignar por el gestor de calidad
        $controller = new CalculateScoreController();   
        $controller->Auxscore();
       
        if($utils->isAdmin()){
            $average = $utils->averagePortal();
            return new JsonResponse(['averagePortal'=>$average],Response::HTTP_OK);
        }

        return new JsonResponse(MensajeScore::UNAUTHORIZED,Response::HTTP_UNAUTHORIZED);

    }
}
