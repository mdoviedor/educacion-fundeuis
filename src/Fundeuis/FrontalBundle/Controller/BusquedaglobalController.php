<?php

namespace Fundeuis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fundeuis\UsuariosBundle\Entity\Departamento;
use Fundeuis\UsuariosBundle\Entity\Ciudad;
use Fundeuis\UsuariosBundle\Entity\Colegio;
use Fundeuis\UsuariosBundle\Entity\Universidad;

class BusquedaglobalController extends Controller {

    public function BuscarciudadAction($departamento, $funcion) {
        $ciudad = new Ciudad();
        $em = $this->getDoctrine()->getManager();
        $ciudad = $em->getRepository('FundeuisFrontalBundle:Ciudad')->findBy(array('departamento' => $departamento));
        return $this->render('FundeuisFrontalBundle:Busquedaglobal:Buscarciudad.html.twig', array('ciudades' => $ciudad, 'funcion' => $funcion));
    }

    public function BuscarcolegioAction($ciudad) {
        $colegio = new Colegio();
        $em = $this->getDoctrine()->getManager();
        $colegio = $em->getRepository('FundeuisFrontalBundle:Colegio')->findBy(array('ciudad' => $ciudad), array('nombre' => 'ASC'));
        return $this->render('FundeuisFrontalBundle:Busquedaglobal:Buscarcolegio.html.twig', array('colegios' => $colegio));
    }

    public function BuscaruniversidadAction($ciudad) {
        $universidad = new Universidad();
        $em = $this->getDoctrine()->getManager();
        $universidad = $em->getRepository('FundeuisFrontalBundle:Universidad')->findBy(array('ciudad' => $ciudad), array('nombre' => 'ASC'));
        return $this->render('FundeuisFrontalBundle:Busquedaglobal:Buscaruniversidad.html.twig', array('universidades' => $universidad));
    }

}
