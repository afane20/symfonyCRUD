<?php

// 
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
//import composer annotacions
use Symfony\Component\Routing\Annotation\Route;
//import @method
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//twig
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

//form
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use UserFacade as UserFacadeLocal;

class UserController extends AbstractController
{


    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        $userFacade  = new UserFacadeLocal($this->getDoctrine()->getManager(),User::class);
        $users = $userFacade->getAllUsers();

        return $this->render('users/user.html.twig', [
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, ['attr' =>
            ['class' => 'form-control mt-2 mb-1']])
            ->add('email', TextType::class, ['attr' =>
            ['class' => 'form-control mt-2 mb-1']])
            ->add('role', TextType::class, ['attr' =>
            ['class' => 'form-control mt-2 mb-1']])
            ->add('save', SubmitType::class, [
                'label' => 'create',
                'attr' => ['class' => 'btn btn-primary mt-2 mb-2']
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $form->getData();
            $userFacade  = new UserFacadeLocal($this->getDoctrine()->getManager(),User::class);
            $userFacade->createUser($newUser);
            return $this->redirectToRoute('view_users');
        }

        return $this->render('users/create.html.twig', ['form' => $form->createView()]);
    }


    public function remove(Request $request, $id)
    {

        $userFacade  = new UserFacadeLocal($this->getDoctrine()->getManager(),User::class);
        $user = $userFacade->deleteUser($id);

        $response = new Response();
        $response->send();
    }


    public function update(Request $request, $id)
    {

        $user = new User();
        $userFacade  = new UserFacadeLocal($this->getDoctrine()->getManager(),User::class);
        $user = $userFacade->getUser($id);
       
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, ['attr' =>
            ['class' => 'form-control mt-2 mb-1']])
            ->add('email', TextType::class, ['attr' =>
            ['class' => 'form-control mt-2 mb-1']])
            ->add('role', TextType::class, ['attr' =>
            ['class' => 'form-control mt-2 mb-1']])
            ->add('save', SubmitType::class, [
                'label' => 'update',
                'attr' => ['class' => 'btn btn-primary mt-2 mb-2']
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userFacade->editUser($user);
            return $this->redirectToRoute('view_users');
        }

        return $this->render('users/update.html.twig', ['form' => $form->createView()]);
        
    }
}
