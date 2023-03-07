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

class EditProviderController extends AbstractController
{
    public function index(Request $request): Response
    {
        $id = $request->attributes->get('id');
        $provider = $this->getDoctrine()->getRepository(Provider::class)->find($id);

        $form = $this->createFormBuilder($provider)
            ->setAction($this->generateUrl('edit_provider_process', array('id' => $id)))
            ->setMethod('PUT')
            ->add('id', IntegerType::class, array(
                'attr' => array(
                    'readonly' => true
                )
            ))
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
            ->add('update', SubmitType::class, ['label' => 'Update'])
            ->getForm();

        return $this->render('edit_provider/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editProvider(Request $request): Response
    {
        $id = $request->attributes->get('id');
        $updatedProvider = new Provider();

        $form = $this->createFormBuilder($updatedProvider)
            ->setAction($this->generateUrl('edit_provider_process', array('id' => $id)))
            ->setMethod('PUT')
            ->add('id', IntegerType::class, array(
                'attr' => array(
                    'readonly' => true
                )
            ))
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
            ->add('update', SubmitType::class, ['label' => 'Update'])
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('PUT') && $form->isSubmitted() && $form->isValid()) {
            $originalProvider = $this->getDoctrine()->getRepository(Provider::class)->find($id);

            $updatedProvider = $form->getData();
            $updatedProvider->setCreationDate($originalProvider->getCreationDate());
            $updatedProvider->setLastUpdated(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($updatedProvider);
            $entityManager->flush();

            return $this->render('edit_provider/index.html.twig', [
                'form' => $form->createView(),
                'successful_update' => true,
                'message' => 'Update successful'
            ]);
        }

        return $this->render('edit_provider/index.html.twig', [
            'form' => $form->createView(),
            'successful_update' => false,
            'message' => 'Something went wrong'
        ]);
    }
}
