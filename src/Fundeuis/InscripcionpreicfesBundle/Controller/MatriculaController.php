<?php

namespace Fundeuis\InscripcionpreicfesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fundeuis\InscripcionpreicfesBundle\Entity\Usuario;
use Fundeuis\InscripcionpreicfesBundle\Entity\Curso;
use Fundeuis\InscripcionpreicfesBundle\Entity\UsuarioCurso;
use Fundeuis\InscripcionpreicfesBundle\Form\UsuarioCursoType;
use Symfony\Component\HttpFoundation\Request;

class MatriculaController extends Controller {
    /*
     * Recibe el id del usuario del modelo Usuario
     */

    public function MatricularAction(Request $request, $id) {
        $usuario = new Usuario();
        $usuarioCurso = new UsuarioCurso();
        $curso = new Curso();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('FundeuisInscripcionpreicfesBundle:Usuario')->find($id);
        $formUsuarioCurso = $this->createForm(new UsuarioCursoType(), $usuarioCurso);
        $curso = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->buscarCursosAño();

        if ($request->getMethod() == "POST") {
            $formUsuarioCurso->handleRequest($request);
            if ($formUsuarioCurso->isValid()) {
                
            }
        }

        return $this->render('FundeuisInscripcionpreicfesBundle:Matricula:Matricular.html.twig', array('formUsuarioCurso' => $formUsuarioCurso->createView(), 'cursos' => $curso, 'usuario' => $usuario));
    }

}
