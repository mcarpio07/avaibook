<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use DateTimeImmutable;

final class QualityAd
{

    private int $id;
    private String $typology;
    private String $description;
    private array $pictureUrls;
    private int $houseSize;
    private ?int $gardenSize = null;
    private ?int $score = null;
    private ?DateTimeImmutable $irrelevantSince = null;
    
    public function __construct()
    {
    }
}
