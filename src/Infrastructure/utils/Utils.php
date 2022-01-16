<?php

namespace App\Controller;

use App\Domain\Ad;
use App\Domain\Picture;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\Rol;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class Utils
{
    
    /**
     * @brief Comprueba si el rol actual es administrador
     */
    public function isAdmin()
    {
        $repository = InFileSystemPersistence::getRepository();
        return strcmp($repository->getSession()->get('user_rol'),Rol::Admin)==0 ? true : false;
    }

    /**
     * @brief Comprueba si el rol actual es usuario
     */
    public function isUser()
    {
        $repository = InFileSystemPersistence::getRepository();
        return strcmp($repository->getSession()->get('user_rol'),Rol::User)==0 ? true : false;
    }

    public function serializeAd(Ad $ad){
        $pictures = $ad->getPictures();
        $jsonPictures = [];
        foreach($pictures as $picture){
            $jsonPictures[]=$this->serializePicture($picture);
        }
        $content = [
            'id' => $ad->getId(),
            'typology' => $ad->getTypology(),
            'description' => $ad->getDescription(),
            'pictures' => $jsonPictures,
            'houseSize' => $ad->getHouseSize(),
            'gardenSize' => $ad->getGardenSize(),
            'score' => $ad->getScore(),
            'irrelevantSince' => $ad->getIrrelevantSince()
        ];
        return $content;
    }

    public function serializePicture(Picture $picture){
        $content = [
            'id' => $picture->getId(),
            'url' => $picture->getUrl(),
            'quality' => $picture->getQuality()
        ];
        return $content;
    }

    public function orderAd(){
        $repository = InFileSystemPersistence::getRepository();
        $ads = $repository->getAds();
        usort($ads, function ($a, $b) {
            $a = $a->getScore();
            $b = $b->getScore();
            if($a == $b) return 0; 
            if($a < $b) return 1;
            return -1;
        });
       $repository->setAds($ads);
    }

    public function averagePortal(){
        $repository = InFileSystemPersistence::getRepository();
        $ads = $repository->getAds();
        $numAds = count($ads);
        $totalScore = 0;
        foreach($ads as $ad) $totalScore += $ad->getScore();

        return $totalScore/$numAds;
        
    }

}
