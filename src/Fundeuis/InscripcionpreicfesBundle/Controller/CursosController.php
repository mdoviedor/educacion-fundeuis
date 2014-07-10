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
        return $this->render('FundeuisInscripcionpreicfesBundle:Cursos:Crear.html.twig', array('formCurso' => $formCurso->createView()));
    }

    public function BuscarAction($parametro, $limite) {
        $curso = new Curso();
        $em = $this->getDoctrine()->getManager();
        $curso = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->findBy(array(), array('idcurso' => 'DESC'), $limite);
        return $this->render('FundeuisInscripcionpreicfesBundle:Cursos:Buscar.html.twig', array('cursos' => $curso, 'limite' => $limite));
    }

    /*
     * Recibe el id correspondiente al idcurso del Modelo Curso
     */

    public function ModificarAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $curso = new Curso();
        $curso = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->find($id);
        $formCurso = $this->createForm(new CursoType(), $curso);
        if ($request->getMethod() == "POST") {
            $formCurso->handleRequest($request);
            if ($formCurso->isValid()) {
                $em->persist($curso);
                $em->flush();
                return $this->redirect($this->generateUrl('fundeuis_inscripcionpreicfes_cursos_buscar'));
            }
        }
        return $this->render('FundeuisInscripcionpreicfesBundle:Cursos:Modificar.html.twig', array('id' => $id, 'formCurso' => $formCurso->createView()));
    }

    /*
     * Recibe el id correspondiente al idcurso del Modelo Curso
     */

    public function VistaAction($id) {
        $em = $this->getDoctrine()->getManager();
        $curso = new Curso();
        $curso = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->find($id);
        return $this->render('FundeuisInscripcionpreicfesBundle:Cursos:Vista.html.twig', array('curso' => $curso));
    }

    public function EliminarAction() {
        
    }

}
