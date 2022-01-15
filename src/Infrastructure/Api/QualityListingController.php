<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Controller\Utils;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class QualityListingController
{
    /**
     * @Route("/listingAdUser", name="listing_ad_user")
     */
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([]);
    }
}
