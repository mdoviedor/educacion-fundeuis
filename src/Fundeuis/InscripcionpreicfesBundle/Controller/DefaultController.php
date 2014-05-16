<?php

namespace Fundeuis\InscripcionpreicfesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FundeuisInscripcionpreicfesBundle:Default:index.html.twig', array('name' => $name));
    }
}
