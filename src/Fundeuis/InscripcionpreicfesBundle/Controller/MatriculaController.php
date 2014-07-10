<?php

namespace Fundeuis\InscripcionpreicfesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fundeuis\InscripcionpreicfesBundle\Entity\Usuario;
use Fundeuis\InscripcionpreicfesBundle\Entity\Curso;
use Fundeuis\InscripcionpreicfesBundle\Entity\UsuarioCurso;
use Fundeuis\InscripcionpreicfesBundle\Form\UsuarioCursoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MatriculaController extends Controller {
    /*
     * Recibe el id del usuario del modelo Usuario
     */

    public function MatricularAction(Request $request, $id) {
        $mensaje = 0;
        $usuario = new Usuario();
        $usuarioCurso = new UsuarioCurso();
        $curso = new Curso();
        $cursoSeleccionado = new Curso();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('FundeuisInscripcionpreicfesBundle:Usuario')->find($id);
        $formUsuarioCurso = $this->createForm(new UsuarioCursoType(), $usuarioCurso);
        $curso = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->buscarCursosAño();

        if ($request->getMethod() == 'POST') {
            $formUsuarioCurso->handleRequest($request);
            if ($formUsuarioCurso->isValid()) {
                $archivo = $formUsuarioCurso->get('archivo')->getData();
                if ($archivo) {
                    $anoAhora = \date('Y');
                    $idCursoLista = $request->request->get('listaCurso');
                    $cursoSeleccionado = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->find($idCursoLista);
                    $dir = 'matriculas/' . $anoAhora . '/' . $idCursoLista . '/';
                    $nombreArchivo = $id . rand(10000, 99999);
                    $usuarioCurso->setNombrearchivo($nombreArchivo);
                    $extension = $archivo->guessExtension(); //Obtener la extensión del archivo cargado
                    $usuarioCurso = $em->getRepository('FundeuisInscripcionpreicfesBundle:UsuarioCurso')->findBy(array('usuario' => $id, 'curso' => $idCursoLista)); //Consula par verificar si el usuario se encuentra matriculado en el curso seleccionado
                    if ($usuarioCurso) {
                        $mensaje = '3';
                    } else {
                        if ($extension && $extension == "zip") {
                            $archivo->move($dir, $nombreArchivo . '.' . $extension); //Mover el archivo al directorio
                            $usuarioCurso->setRutaarchivo($dir);
                            $usuarioCurso->setUsuario($usuario);
                            $usuarioCurso->setCurso($cursoSeleccionado);
                            $em->persist($usuarioCurso);
                            $em->flush();
                            return $this->redirect($this->generateURL('fundeuis_usuarios_verestudiantepreicfes', array('id' => $id)));
                        } else {
                            $mensaje = "2";
                        }
                    }
                } else {
                    $mensaje = "1";
                }
            }
        }

        $usuarioCurso = $em->getRepository('FundeuisInscripcionpreicfesBundle:UsuarioCurso')->findBy(array('usuario' => $id), array('idusuariocurso' => 'DESC'), 1); //Consula par verificar si el usuario se encuentra matriculado en el curso seleccionado
        //echo $usuarioCurso[0]->getCurso()->getFechafin() . 'hola';
        $ahora = \date('y-m-d');
        if ($usuarioCurso[0]->getCurso()->getFechafin() > new \DateTime($ahora)) {
            $mensaje = '4';
        }
        return $this->render('FundeuisInscripcionpreicfesBundle:Matricula:Matricular.html.twig', array('mensaje' => $mensaje, 'formUsuarioCurso' => $formUsuarioCurso->createView(), 'cursos' => $curso, 'usuario' => $usuario));
    }

}
