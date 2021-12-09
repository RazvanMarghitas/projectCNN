<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="app_homepage")
     */
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('command', ChoiceType::class, [
                'choices' => [
                    'set speed 0' => 'set speed 0',
                    'set speed 1' => 'set speed 1',
                    'set speed 2' => 'set speed 2',
                    'set speed 3' => 'set speed 3',
                    'status' => 'status',
                ]
            ])
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $response = $this->redirectToRoute('showpage', [
                'data' => $data['command'],
            ]);
            return $response;
        }
        return $this->render('pages/homepage.html.twig', [
            'select_form' => $form->createView(),
        ]);
    }
}