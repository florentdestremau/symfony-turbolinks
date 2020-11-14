<?php

namespace App\Controller;

use Helthe\Component\Turbolinks\Turbolinks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
        return $this->render(
            'static/index-2.html.twig',
            [
                'controller_name' => 'StaticController',
                'token'           => $request->query->get('token'),
                'data'           => $request->query->get('data'),
            ]
        );
    }

    /**
     * @Route("/redirect-to-2", name="redirect_to_2")
     */
    public function redirectToIndex2(): Response
    {
        $this->addFlash('success', 'Thank you');

        return new RedirectResponse(
            $this->generateUrl(
                'static-2',
                ['token' => substr(chunk_split(bin2hex(random_bytes(12)), 4, '-'), 0, -1)],
                UrlGeneratorInterface::ABSOLUTE_URL
            )
        );
    }
}
