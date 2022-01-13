<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Ad;
use App\Domain\Picture;

final class InFileSystemPersistence
{
    private array $ads = [];
    private array $pictures = [];
    private static InFileSystemPersistence $repository;

    public function __construct()
    {
        array_push($this->ads, new Ad(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null));
        array_push($this->ads, new Ad(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, null, null));
        array_push($this->ads, new Ad(3, 'CHALET', '', [2], 300, null, null, null));
        array_push($this->ads, new Ad(4, 'FLAT', 'Ático céntrico muy luminoso y recién reformado, parece nuevo', [5], 300, null, null, null));
        array_push($this->ads, new Ad(5, 'FLAT', 'Pisazo,', [3, 8], 300, null, null, null));
        array_push($this->ads, new Ad(6, 'GARAGE', '', [6], 300, null, null, null));
        array_push($this->ads, new Ad(7, 'GARAGE', 'Garaje en el centro de Albacete', [], 300, null, null, null));
        array_push($this->ads, new Ad(8, 'CHALET', 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', [1, 7], 300, null, null, null));

        array_push($this->pictures, new Picture(1, 'https://www.idealista.com/pictures/1', 'SD'));
        array_push($this->pictures, new Picture(2, 'https://www.idealista.com/pictures/2', 'HD'));
        array_push($this->pictures, new Picture(3, 'https://www.idealista.com/pictures/3', 'SD'));
        array_push($this->pictures, new Picture(4, 'https://www.idealista.com/pictures/4', 'HD'));
        array_push($this->pictures, new Picture(5, 'https://www.idealista.com/pictures/5', 'SD'));
        array_push($this->pictures, new Picture(6, 'https://www.idealista.com/pictures/6', 'SD'));
        array_push($this->pictures, new Picture(7, 'https://www.idealista.com/pictures/7', 'SD'));
        array_push($this->pictures, new Picture(8, 'https://www.idealista.com/pictures/8', 'HD'));

        $this->assignRandomImages();
    }

    /**
     * @brief Asignamos a cada anuncio un numero aleatorio de imagenes dentro de las creadas
     */
    private function assignRandomImages(){
        foreach($this->ads as $ad){
            $numImages = rand(0,count($this->pictures)-1);
            $this->assignNumImages($numImages,$ad);
        }
    }

    /**
     * @brief Asignar tantas un numero determinado de imagenes a un anuncio
     */
    private function assignNumImages(int $numImages, Ad $ad)
    {
        $images = [];
        for($numImages;$numImages>0;$numImages--){  
            $idImage = rand(reset($this->pictures)->getId(),end($this->pictures)->getId());
            $image = $this->searchImageForId($idImage);
            if(!empty($image)) array_push($images,$image);
        }
        $ad->setPictures($images);
    }

    /**
     * @brief Busca una imagen por id
     */
    private function searchImageForId(int $idImage): ?Picture
    {
        foreach($this->pictures as $image){
            if($image->getId()==$idImage) return $image;
        }
        return null;
    }


    public static function getRepository()
    {
        if(!isset(self::$repository)) 
        {
            self::$repository = new InFileSystemPersistence();
        }
        return self::$repository;
    }

    /**
     * Get the value of ads
     */ 
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * Set the value of ads
     *
     * @return  self
     */ 
    public function setAds($ads)
    {
        $this->ads = $ads;

        return $this;
    }

    /**
     * Get the value of pictures
     */ 
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Set the value of pictures
     *
     * @return  self
     */ 
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;

        return $this;
    }
}
