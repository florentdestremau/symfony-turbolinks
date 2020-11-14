<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    /**
     * @Route("/", name="static")
     */
    public function index(): Response
    {
        return $this->render(
            'static/index.html.twig',
            [
                'controller_name' => 'StaticController',
            ]
        );
    }

    /**
     * @Route("/static-two", name="static-2")
     */
    public function index2(Request $request): Response
    {
        sleep(2);

        return $this->render(
            'static/index-2.html.twig',
            [
                'controller_name' => 'StaticController',
                'data'            => random_int(50, 40000),
                'token'           => $request->query->get('token'),
            ]
        );
    }

    /**
     * @Route("/redirect-to-2", name="redirect_to_2")
     */
    public function redirectToIndex2(): Response
    {
        sleep(1);

        return $this->redirectToRoute('redirect_to_2', ['token' => uniqid('', true)]);
    }
}
