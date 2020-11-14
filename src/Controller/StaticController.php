<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index2(): Response
    {
        sleep(2);

        return $this->render(
            'static/index-2.html.twig',
            [
                'controller_name' => 'StaticController',
                'data'            => random_int(50, 40000),
            ]
        );
    }
}
