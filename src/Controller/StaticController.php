<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StaticController extends AbstractController
{
    /**
     * @Route("/", name="index")
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
     * @Route("/other", name="other")
     */
    public function other(Request $request): Response
    {
        sleep(1);

        return $this->render(
            'static/other.html.twig',
            [
                'controller_name' => 'StaticController',
                'data'            => $request->query->get('data'),
            ]
        );
    }

    /**
     * @Route("/redirect-to-other", name="redirect_to_other")
     */
    public function redirectToIndex2(): Response
    {
        $this->addFlash('success', 'You have been redirected :)');

        return new RedirectResponse(
            $this->generateUrl('other', [], UrlGeneratorInterface::ABSOLUTE_URL)
        );
    }
}
