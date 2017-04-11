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
        return new Response('Liste des clients');
    }

    public function createAction()
    {
        return new Response('Creation du client');
    }

    public function detailsAction($id)
    {
        return new Response('Details du client ' . $id);
    }

    public function updateAction($id)
    {
        return new Response('Mise a jour client ' . $id);
    }

    public function deleteAction($id)
    {
        return new Response('Supression du client ' . $id);
    }
}
