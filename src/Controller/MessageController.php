<?php

namespace App\Controller;

use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", methods={"GET", "POST"}, name="message")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(
            BookingType::class,
            null,
            [
                'action' => $this->generateUrl('message'),
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                sleep(1);
                $this->addFlash('success', 'Thank you for your submitting!');

                return $this->redirectToRoute(
                    'message_success',
                    [
                        'data' => $form->getData(),
                    ]
                );
            }

            return $this->render(
                'message/form.html.twig',
                [
                    'form' => $form->createView(),
                ],
                new Response(null, Response::HTTP_BAD_REQUEST)
            );
        }

        return $this->render(
            'message/form.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/message_success", methods={"GET"}, name="message_success")
     */
    public function messageSuccess(Request $request)
    {
        return $this->render('message/success.html.twig', ['data' => $request->query->get('data')]);
    }
}
