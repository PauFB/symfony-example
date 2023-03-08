<?php

namespace App\Controller;

use App\Entity\Provider;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateProviderController extends AbstractController
{
    public function index(): Response
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('create_provider_process'))
            ->setMethod('POST')
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', IntegerType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Hotel' => 'hotel',
                    'Ski slope' => 'ski slope',
                    'Complement' => 'complement'
                ]
            ])
            ->add('isActive', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ]
            ])
            ->add('create', SubmitType::class, ['label' => 'Create'])
            ->getForm();

        return $this->render('create_provider/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function createProvider(Request $request): Response
    {
        $newProvider = new Provider();

        $form = $this->createFormBuilder($newProvider)
            ->setAction($this->generateUrl('create_provider_process'))
            ->setMethod('POST')
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Hotel' => 'hotel',
                    'Ski slope' => 'ski slope',
                    'Complement' => 'complement'
                ]
            ])
            ->add('isActive', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ]
            ])
            ->add('create', SubmitType::class, ['label' => 'Create'])
            ->getForm();
        
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $newProvider = $form->getData();
            $newProvider->setCreationDate(new \DateTime());
            $newProvider->setLastUpdated(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newProvider);
            $entityManager->flush();

            return $this->render('create_provider/index.html.twig', [
                'form' => $form->createView(),
                'successful_creation' => true,
                'message' => 'Creation successful'
            ]);
        }

        return $this->render('create_provider/index.html.twig', [
            'form' => $form->createView(),
            'successful_creation' => false,
            'message' => 'Something went wrong'
        ]);
    }
}
