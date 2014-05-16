<?php

namespace Fundeuis\InscripcionpreicfesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fundeuis\InscripcionpreicfesBundle\Entity\Curso;
use Fundeuis\InscripcionpreicfesBundle\Form\CursoType;
use Symfony\Component\HttpFoundation\Request;

class CursosController extends Controller {

    public function CrearAction(Request $request) {
        $curso = new Curso();
        $formCurso = $this->createForm(new CursoType(), $curso);
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $formCurso->handleRequest($request);
            if ($formCurso->isValid()) {
                $em->persist($curso);
                $em->flush();
                return $this->redirect($this->generateUrl('fundeuis_inscripcionpreicfes_cursos_buscar'));
            }
        }
        return $this->render('FundeuisInscripcionpreicfesBundle:Cursos:crear.html.twig', array('formCurso' => $formCurso->createView()));
    }

    public function BuscarAction() {
        
    }

    public function ModificarAction() {
        
    }

    public function EliminarAction() {
        
    }

}
