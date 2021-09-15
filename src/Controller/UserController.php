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

class UserController extends AbstractController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($newUser);
            $em->flush();
            return $this->redirectToRoute('view_users');
        }

        return $this->render('users/create.html.twig', ['form' => $form->createView()]);
    }


    public function remove(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(
            User::class
        )->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $response = new Response();
        $response->send();
    }


    public function update(Request $request, $id)
    {

        $user = new User();
        $user = $this->getDoctrine()->getRepository(
            User::class
        )->find($id);
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
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('view_users');
        }

        return $this->render('users/update.html.twig', ['form' => $form->createView()]);
        
    }
}
