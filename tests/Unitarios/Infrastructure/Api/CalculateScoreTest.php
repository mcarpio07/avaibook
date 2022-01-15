<?php

namespace App\Tests\Unitarios\Infrastructure\Api;

use App\Domain\Ad;
use App\Domain\Picture;
use PHPUnit\Framework\TestCase;

class CalculateScoreTest extends TestCase
{
    /** @test */
    public function calculateScoreOk(): void
    {
        $pictures =  Array();
        array_push($pictures, new Picture(4, 'https://www.idealista.com/pictures/4', 'HD'));
        $ad = new Ad(100, 'FLAT', 
        'Atico céntrico muy luminoso y recién reformado, parece nuevo, además cuenta con unas vistas a la playa muy satisfactorias. La vivienda tiene 2 baños, 1 salón y una cocina recien remodelada', 
        $pictures, 300, null, null, null); //Anuncio que debería de tener 60 de puntuación comprobando con una descripcion de menos de 50 palabras y siendo piso
        $ad->calculateScore();

        $this->assertEquals($ad->getScore(), 60);
    }

    /** @test */
    public function calculateBadAd(): void
    {
        $pictures =  Array();
        $ad = new Ad(101, 'CHALET', '', $pictures, 300, null, null, null); //Anuncio con 0 de puntuación
        $ad->calculateScore();

        $this->assertEquals($ad->getScore(), 0);
    }


}
