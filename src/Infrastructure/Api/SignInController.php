<?php

namespace App\Infrastructure\Api;

use App\Infrastructure\Persistence\InFileSystemPersistence;
use App\Infrastructure\Persistence\Rol;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    /**
     * @Route("/login", name="sign_in")
     */
    public function login(Request $request): Response
    {
        $sesion = $request->getSession();
        $parameters = json_decode($request->getContent(), true);
        $repository = InFileSystemPersistence::getRepository();
        $user = $parameters['username'];
        $pass = $parameters['password'];
        if(!empty($user = $repository->login($user,$pass))){
            $sesion->set('user_rol',$user->getRol());
            return new Response($sesion->get('user_rol'),Response::HTTP_ACCEPTED); 
        }

        return new Response($sesion->get('user_rol'),Response::HTTP_UNAUTHORIZED); 


        
    }

    /**
     * @Route("/unlogin", name="desconect")
     */
    public function unlogin(Request $request): Response
    {
        $repository = InFileSystemPersistence::getRepository();        
        $repository->unlogin();
        $sesion = $request->getSession();

        return new Response($sesion->get('user_rol'),Response::HTTP_OK);
    }
}
