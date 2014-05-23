<?php

namespace Fundeuis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fundeuis\UsuariosBundle\Entity\Departamento;
use Fundeuis\UsuariosBundle\Entity\Ciudad;

class BusquedaglobalController extends Controller {

    public function BuscarciudadAction($departamento, $funcion) {
        $ciudad = new Ciudad();
        $em = $this->getDoctrine()->getManager();
        $ciudad = $em->getRepository('FundeuisFrontalBundle:Ciudad')->findBy(array('departamento' => $departamento));

        return $this->render('FundeuisFrontalBundle:Busquedaglobal:Buscarciudad.html.twig', array('ciudades' => $ciudad, 'funcion' => $funcion));
    }

    public function BuscarcolegioAction() {
        
    }

    public function BuscaruniversidadAction() {
        
    }

}
