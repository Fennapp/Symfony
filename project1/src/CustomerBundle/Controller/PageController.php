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
            ->add('email','email', [
                'label' =>'Adresse email: ',
                'label_attr'=>['class'=>'text-capitalize'],
             ])
            ->add('subject', 'text',['required' => true])
            ->add('service', 'choice', [
                // Attention: Clé/Valeur inversées version < 2.7
                'choices' => [
                    'Service commercial'  => 1,
                    'Service facturation' => 2,
                    'Service technique'   => 3,
                ],
                'choices_as_values' => true, // (Requis < 3.0)
                'expanded'    => false, // False by default, Select => Radio
                'multiple'    => false, // False by default, Radio => Checkboxes
                'placeholder' => 'Choisissez un service',
            ])
            ->add('message', 'textarea')
            ->add('copy', 'checkbox',['required' => false])
            ->add('attachment', 'file', ['required' => false])
            ->add('send', 'submit')
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
                {
                    $data=$form->getData();
                    /*$body = $this->renderView(
                    'CustomerBundle:Email:contact.html.twig',
                    ['data' => $data]);

                    $email = $this->getParameter('recipient');

                    /** @var \Swift_Mime_SimpleMessage $message
                    $message = \Swift_Message::newInstance()
                    ->setTo($email)
                    ->setFrom($data['email'])
                    ->setSubject($data['subject'])
                    //->setBody($data['message'])
                    ->setBody($body, 'text/html');*/

                    $sent = $this->get('mailer')->send($message);
                    	$sent = $this
                        ->get('customer.notifier')
                        ->notify($data);

                    if (0 < $sent) {
                        $this->addFlash('success', 'Email envoyé !');
                    }

            /* Symfony\Component\HttpFoundation\File\UploadedFile */
                    if ($file = $data['attachment']) 
                    {
                        // $fileName = $file->getClientOriginalName();
                        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    
                        $dir = $this->getParameter('kernel.root_dir') . '/../var/data';
                    
                        // Move the file to the directory
                        $file->move($dir, $fileName);
                    }

                    return $this->redirectToRoute('customer_homepage');

            return $this->render('CustomerBundle:Page:contact.html.twig', [
            'form' => $form->createview(),
            'data' => $data,
            ]);
        }
    }
}