<?php
namespace CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function homeAction()
    {
        return $this->render('CustomerBundle:Page:home.html.twig');
    }

    public function contactAction()
    {
        return $this->render('CustomerBundle:Page:contact.html.twig');
    }
}