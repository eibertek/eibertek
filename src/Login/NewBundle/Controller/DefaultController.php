<?php

namespace Login\NewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LoginNewBundle:Default:index.html.twig', array('name' => 'Querido ' . $name));
    }
}
