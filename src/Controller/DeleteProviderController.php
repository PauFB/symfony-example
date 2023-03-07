<?php

namespace App\Controller;

use App\Entity\Provider;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProviderController extends AbstractController
{
    public function index(Request $request): Response
    {
        $id = $request->attributes->get('id');
        $provider = $this->getDoctrine()->getRepository(Provider::class)->find($id);

        return $this->render('delete_provider/index.html.twig', [
            'provider' => $provider,
        ]);
    }

    public function deleteProvider(Request $request): Response
    {
        $id = $request->attributes->get('id');
        $provider = $this->getDoctrine()->getRepository(Provider::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($provider);
        $entityManager->flush();

        return $this->redirectToRoute('provider_list');
    }
}
