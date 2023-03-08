<?php

namespace App\Controller;

use App\Entity\Provider;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListProviderController extends AbstractController
{
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $providers = $repository->findAll();

        return $this->render('list_provider/index.html.twig', [
            'providers' => $providers
        ]);
    }
}
