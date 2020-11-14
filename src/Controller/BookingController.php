<?php

namespace App\Controller;

use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", methods={"GET", "POST"}, name="booking")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(
            BookingType::class,
            null,
            [
                'action' => $this->generateUrl('booking'),
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                sleep(2);
                $this->addFlash('success', 'Thank you for your booking !');

                return $this->redirectToRoute(
                    'static-2',
                    [
                        'data'  => $form->getData(),
                        'token' => substr(chunk_split(bin2hex(random_bytes(12)), 4, '-'), 0, -1),
                    ]
                );
            }

            return $this->render(
                'booking/index.html.twig',
                [
                    'form' => $form->createView(),
                ],
                new Response(null, Response::HTTP_BAD_REQUEST)
            );
        }

        return $this->render(
            'booking/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/booking", methods={"POST"}, name="booking_post")
     */
    public function post(Request $request)
    {
        $form = $this->createForm(
            BookingType::class,
            null,
            ['action' => $this->generateUrl('booking_post')]
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->addFlash('success', 'Thank you for your booking !');

            return $this->redirectToRoute(
                'static-2',
                [
                    'data'  => $form->getData(),
                    'token' => substr(chunk_split(bin2hex(random_bytes(12)), 4, '-'), 0, -1),
                ]
            );
        }

        return $this->render(
            'booking/index.html.twig',
            [
                'form' => $form->createView(),
            ],
            new Response(null, Response::HTTP_BAD_REQUEST)
        );
    }
}
