<?php

namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CustomerBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        return $this->render('CustomerBundle:Default:list.html.twig');
    }

    public function createAction()
    {
        return $this->render('CustomerBundle:Default:create.html.twig');
    }

    public function detailsAction($id)
    {
        //return new Response('Details du client ' . $id);
        return $this->render('CustomerBundle:Default:details.html.twig', [
            'customer_id' => $id, 
        ]);
    }

    public function updateAction($id)
    {
       //return new Response('Mise a jour client ' . $id);
        return $this->render('CustomerBundle:Default:update.html.twig', [
            'customer_id' => $id,
        ]);
    }

    public function deleteAction($id)
    {
        //return new Response('Supression du client ' . $id);
        return $this->render('CustomerBundle:Default:delete.html.twig', [
            'customer_id' => $id,
        ]);
    }
}
