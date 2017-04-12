<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CustomerBundle\Form\CustomerType;
use CustomerBundle\Entity\Customer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\IsTrue;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CustomerBundle:Default:index.html.twig');
    }

    public function listAction()
    {
       $repo = $this->getDoctrine()->getRepository('CustomerBundle:Customer');
       $customer = $repo->findAll();
      
        return $this->render('CustomerBundle:Default:list.html.twig',[
            'customers' => $customer,
        ]);
    }

    public function createAction(Request $request)
    {
        $customer = new Customer();

        $form = $this
            ->createForm(new CustomerType(), $customer)
            ->add('submit', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('customer_homepage');
        }
        
        return $this->render('CustomerBundle:Default:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function detailsAction($id)
    {
        $customer = $this
            ->getDoctrine()
            ->getRepository('CustomerBundle:Customer')
            ->find($id);

        if (!$customer) {
            throw $this->createNotFoundException(
                'Customer not found'
            );
        }

        return $this->render('CustomerBundle:Default:details.html.twig', [
            'customer' => $customer,
        ]);
    }

    public function updateAction(Request $request)
    {

        $id = $request->attributes->get('id');

        $customer = $this
            ->getDoctrine()
            ->getRepository('CustomerBundle:Customer')
            ->find($id);
        
        $form = $this
            ->createForm(new CustomerType(), $customer)
            ->add('Update', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('customer_list');
        }

       //return new Response('Mise a jour client ' . $id);
        return $this->render('CustomerBundle:Default:update.html.twig', [
            'customer_id' => $id,
             'form' => $form->createView(),
        ]);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->attributes->get('id');

        $customer = $this
            ->getDoctrine()
            ->getRepository('CustomerBundle:Customer')
            ->find($id);

        $form = $this
            ->createFormBuilder()
            ->add('confirm', 'checkbox', [
                'label' => 'Confirmer la suppression ?',
                'required' => false,
                'constraints' => [
                    new IsTrue(),
                ]
            ])
            ->add('Supprimer', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();

            return $this->redirectToRoute('customer_list');
        }
        //return new Response('Supression du client ' . $id);
        return $this->render('CustomerBundle:Default:delete.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}