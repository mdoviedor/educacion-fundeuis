<?php

namespace Fundeuis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FundeuisFrontalBundle:Default:index.html.twig', array('name' => $name));
    }
}
