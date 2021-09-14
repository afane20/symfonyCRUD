<?php

// 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
//import composer annotacions
use Symfony\Component\Routing\Annotation\Route;
//import @method
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//twig
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
    * @Route("/welcome")
    * @Method({"GET"})
    */
    public function index()
    {
        $message ="hello !!";
        
        return $this->render('users/user.html.twig',[
            'message' => $message
        ]);
    }
}