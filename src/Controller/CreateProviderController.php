<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateProviderController extends AbstractController
{
    /**
     * @Route("/create/provider", name="app_create_provider")
     */
    public function index(): Response
    {
        /*return $this->render('create_provider/index.html.twig', [
            'controller_name' => 'CreateProviderController',
        ]);*/
        return $this->render('create_provider/index.html.twig');
    }
}
