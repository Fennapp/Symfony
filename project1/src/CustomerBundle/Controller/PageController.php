<?php
namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function homeAction()
    {
        return $this->render('CustomerBundle:Page:home.html.twig');
    }

    public function contactAction(Request $request)
    {
        $data = [
            'email'=> null,
            'subject'=> null,
            'message'=> null,
            'copy'=> null,
            'send'=> null,
        ];

        $form = $this->createFormBuilder($data)
            ->add('email')
            ->add('subject')
            ->add('message', 'textarea')
            ->add('copy', 'checkbox')
            ->add('send', 'submit')
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
                {
                    $data=$form->getData();
                    //return$this->redirectToRoute('');
                }

        return $this->render('CustomerBundle:Page:contact.html.twig', [
            'form' => $form->createview(),
        ]);
    }
}