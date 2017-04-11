<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TestBundle:Default:index.html.twig');
    }

    public function fooAction()
    {
        return new Response ('FooTest');
    }

    public function barAction()
    {
        return new Response ('BarTest');
    }

    public function testparamAction($testparam)
    {
        return new Response ('Parametre : ' . $testparam);
    }

    public function numberAction($number)
    {
        return new Response('Number : ' . $number);
    }

    public function TestfooAction()
    {
        return new Response('Foo !');
    }
}
