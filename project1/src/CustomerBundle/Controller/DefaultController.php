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
        $this->render('CustomerBundle:Default:list.html.twig');
    }

    public function createAction()
    {
        return new Response('Creation du client');
        $this->render('CustomerBundle:Default:create.html.twig');
    }

    public function detailsAction($id)
    {
        return new Response('Details du client ' . $id);
        $this->render('CustomerBundle:Default:details.html.twig');
    }

    public function updateAction($id)
    {
        return new Response('Mise a jour client ' . $id);
        $this->render('CustomerBundle:Default:update.html.twig');
    }

    public function deleteAction($id)
    {
        return new Response('Supression du client ' . $id);
        $this->render('CustomerBundle:Default:delete.html.twig');
    }
}
