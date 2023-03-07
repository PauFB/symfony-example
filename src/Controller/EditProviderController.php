<?php

namespace App\Controller;

use App\Entity\Provider;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditProviderController extends AbstractController
{
    public function index(Request $request): Response
    {
        $id = $request->attributes->get('id');
        $provider = $this->getDoctrine()->getRepository(Provider::class)->find($id);

        return $this->render('edit_provider/index.html.twig', [
            'provider' => $provider
        ]);
    }
}
