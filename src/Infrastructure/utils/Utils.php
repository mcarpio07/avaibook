<?php

namespace App\Controller;

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
}
