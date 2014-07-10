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
        $usuarioCursoMatriculado = new UsuarioCurso();
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
                    $idCursoLista = $request->request->get('listaCurso'); //Obtener id del curso
                    $extension = $archivo->guessExtension(); //Obtener la extensión del archivo cargado
                    $usuarioCursoMatriculado = $em->getRepository('FundeuisInscripcionpreicfesBundle:UsuarioCurso')->findBy(array('usuario' => $id, 'curso' => $idCursoLista)); //Consula par verificar si el usuario se encuentra matriculado en el curso seleccionado
                    if ($usuarioCursoMatriculado) {
                        $mensaje = '3';
                    } else {
                        if ($extension && $extension == "zip") {
                            $anoAhora = \date('Y');
                            $cursoSeleccionado = $em->getRepository('FundeuisInscripcionpreicfesBundle:Curso')->find($idCursoLista); //Curso seleccionado.
                            $dir = 'matriculas/' . $anoAhora . '/' . $idCursoLista . '/';
                            $nombreArchivo = $id . rand(10000, 99999);
                            $usuarioCurso->setNombrearchivo($nombreArchivo);
                            $usuarioCurso->setRutaarchivo($dir);
                            $usuarioCurso->setUsuario($usuario);
                            $usuarioCurso->setCurso($cursoSeleccionado);
                            $archivo->move($dir, $nombreArchivo . '.' . $extension); //Mover el archivo al directorio                            
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
        if ($usuarioCurso && $usuarioCurso[0]->getCurso()->getFechafin() > new \DateTime($ahora)) {
            $mensaje = '4';
        }
        return $this->render('FundeuisInscripcionpreicfesBundle:Matricula:Matricular.html.twig', array('mensaje' => $mensaje, 'formUsuarioCurso' => $formUsuarioCurso->createView(), 'cursos' => $curso, 'usuario' => $usuario));
    }

    /*
     * Acción para cambiar el estado de la matricula del estudiante. 
     * Si esta matriculado pasa a pre matriculado y viceversa.    
     */

    public function CambiarestadoAction(Request $request, $id) {
        $usuarioCurso = new UsuarioCurso();
        $em = $this->getDoctrine()->getManager();

        $usuarioCurso = $em->getRepository('FundeuisInscripcionpreicfesBundle:UsuarioCurso')->find($id);
        if ($usuarioCurso->getEstado()) {
            $usuarioCurso->setEstado(false);
        } else {
            $usuarioCurso->setEstado(true);
        }
        $em->persist($usuarioCurso);
        $em->flush();

        return $this->redirect($this->generateURL('fundeuis_inscripcionpreicfes_cursos_vista', array('id' => $usuarioCurso->getCurso()->getIdcurso())));
    }

    /*
     * Acción para eliminar la matricula del estudiante. 
     */

    public function EliminarAction($id) {
        $usuarioCurso = new UsuarioCurso();
        $em = $this->getDoctrine()->getManager();
        $usuarioCurso = $em->getRepository('FundeuisInscripcionpreicfesBundle:UsuarioCurso')->find($id);
        $fs = new Filesystem(); //Eliminar archivo fisico correspondiente a la matricula del estudiante
        $fs->remove($usuarioCurso->getRutaarchivo() . $usuarioCurso->getNombrearchivo() . '.zip');

        $em->remove($usuarioCurso);
        $em->flush();
        return $this->redirect($this->generateURL('fundeuis_inscripcionpreicfes_cursos_vista', array('id' => $usuarioCurso->getCurso()->getIdcurso())));
    }

}
