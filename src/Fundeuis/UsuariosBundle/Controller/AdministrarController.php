<?php

namespace Fundeuis\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fundeuis\UsuariosBundle\Entity\Usuario;
use Fundeuis\UsuariosBundle\Entity\Ciudad;
use Fundeuis\UsuariosBundle\Entity\Departamento;
use Fundeuis\UsuariosBundle\Entity\Estudiantepreicfes;
use Fundeuis\UsuariosBundle\Form\UsuarioType;
use Fundeuis\UserBundle\Entity\User;
use Fundeuis\UsuariosBundle\Form\EstudiantepreicfesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Fundeuis\UsuariosBundle\Funciones\RedimencionarImagen;
use FOS\UserBundle\Model\UserManagerInterface;

class AdministrarController extends Controller {
    /*
     * Crear usuario. Estudiante Preicfes
     */

    public function CrearAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $u = $userManager->createUser();
        $usuario = new Usuario();
        $ciudad = new Ciudad();
        $departamento = new Departamento();
        $departamento = $em->getRepository('FundeuisUsuariosBundle:Departamento')->findAll();


        $redimencionarImagen = new RedimencionarImagen();
        $estudiantePreIcfes = new Estudiantepreicfes();

        $formUsuario = $this->createForm(new UsuarioType(), $usuario);


        if ($request->getMethod() == 'POST') {
            $formUsuario->handleRequest($request);
            $c = $request->request->get('listaCiudad');
            if ($formUsuario->isValid() && $c) {
                $email = $formUsuario->get('correoElectronico')->getData();
                $username = $formUsuario->get('numerodocumentoidentidad')->getData();
                $ciudad = $em->getRepository('FundeuisUsuariosBundle:Ciudad')->find($c);

                $user = new User();
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setEnabled(true);
                $user->setPlainPassword($username);
                $user->r('ROLE_ESTUDIANTEPREICFES');

                $userManager->updateUser($user); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush();


                $usr = new User();
                $usr = $em->getRepository('FundeuisUsuariosBundle:User')->findBy(array('username' => $username));
                $usuario->setUser($usr[0]);
                $usuario->setCiudad($ciudad);

                $em->persist($usuario);
                $em->flush($usuario);

                return $this->redirect($this->generateURL('fundeuis_usuarios_crearestudiantepreicfes', array('id' => $username)));
            }
        }
        return $this->render('FundeuisUsuariosBundle:Administrar:Crear.html.twig', array('formUsuario' => $formUsuario->createView(), 'departamentos' => $departamento));
    }

    /*
     * Recibe el id, correspondiente al numero de documento de identidad del usuario. 
     * Crear estudiante preicfes
     */

    public function CrearestudiantepreicfesAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $departamento = new Departamento();
        $departamento = $em->getRepository('FundeuisUsuariosBundle:Departamento')->findAll();
        $redimencionarImagen = new RedimencionarImagen();
        $estudiantePreIcfes = new Estudiantepreicfes();
        $formEstudiantesPreIcfes = $this->createForm(new EstudiantepreicfesType(), $estudiantePreIcfes);
        if ($request->getMethod() == 'POST') {

            $formEstudiantesPreIcfes->handleRequest($request);
            $u = $request->request->get('listaUniversidad');
            $c = $request->request->get('listaColegio');

            if ($formEstudiantesPreIcfes->isValid() && $c && $u) {
                $colegio = $em->getRepository('FundeuisUsuariosBundle:Colegio')->find($c);
                $universidad = $em->getRepository('FundeuisUsuariosBundle:Universidad')->find($u);
                $usuario = $em->getRepository('FundeuisUsuariosBundle:Usuario')->findOneBy(array('numerodocumentoidentidad' => $id));
                $foto = $formEstudiantesPreIcfes->get('archivo')->getData();

                if ($foto) {
                    $ano = \date('Y');
                    $dir = 'images/foto/' . $ano . '/';
                    //$nombreArchivo = rand(10000, 99999);
                    $nombreArchivo = $usuario->getUser()->getEmail();
                    $extension = $foto->guessExtension();
                    if ($extension && ($extension == "JPG" || $extension == "JPeG" || $extension == "jpeg" || $extension == "jpg")) {
                        $estudiantePreIcfes->setFoto($dir . $nombreArchivo . '.' . "jpg"); //Instancia del modelo Produccionintelectual, nombre 
                        $foto->move($dir, $nombreArchivo . '.' . "jpg"); //Mover el archivo al directorio
                        $redimencionarImagen->redimencionar($estudiantePreIcfes->getFoto(), $dir);
                    }
                }


                $estudiantePreIcfes->setUniversidad($universidad);
                $estudiantePreIcfes->setColegio($colegio);
                $estudiantePreIcfes->setUsuario($usuario);

                $em->persist($estudiantePreIcfes);
                $em->flush($estudiantePreIcfes);
            }
            return $this->redirect($this->generateURL('fundeuis_usuarios_buscar'));
        }
        return $this->render('FundeuisUsuariosBundle:Administrar:Crearestudiantepreicfes.html.twig', array('departamentos' => $departamento, 'id' => $id, 'formEstudiantePreIcfes' => $formEstudiantesPreIcfes->createView()));
    }

    /*
     * Modificar estudiante de educacion no formal. Datos
     */

    public function ModificarAction(Request $request, $id) {

        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FundeuisUserBundle:User')->find($id);

        foreach ($user->getRoles() as $value) {

            if ($value == 'ROLE_ESTUDIANTEPREICFES') {

                $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
                $u = $userManager->createUser();
                $usuario = new Usuario();
                $ciudad = new Ciudad();
                $departamento = new Departamento();
                $departamento = $em->getRepository('FundeuisUsuariosBundle:Departamento')->findAll();


                $redimencionarImagen = new RedimencionarImagen();
                $estudiantePreIcfes = new Estudiantepreicfes();

                $usuario = $em->getRepository('FundeuisUsuariosBundle:Usuario')->findOneBy(array('numerodocumentoidentidad' => $user->getUsername()));
                $formUsuario = $this->createForm(new UsuarioType(), $usuario);


                if ($request->getMethod() == 'POST') {
                    $formUsuario->handleRequest($request);

                    if ($formUsuario->isValid()) {
                        $email = $formUsuario->get('correoElectronico')->getData();
                        $username = $formUsuario->get('numerodocumentoidentidad')->getData();
                        $c = $request->request->get('listaCiudad');


                        //$user = new User();
//                        $user->setEnabled(true);

                        $user->setEmail($email);

//                        if ($username) {
//                            $user->setUsername($username);
//                            $user->setPlainPassword($username);
//                        }
                        // $user->r('ROLE_ESTUDIANTEPREICFES');

                        $userManager->updateUser($user); //Actualizacion del contenido del manejador
                        $this->getDoctrine()->getManager()->flush();

                        if ($c) {
                            $ciudad = $em->getRepository('FundeuisUsuariosBundle:Ciudad')->find($c);
                            $usuario->setCiudad($ciudad);
                        }
                        $em->persist($usuario);
                        $em->flush($usuario);

                        return $this->redirect($this->generateURL('fundeuis_usuarios_modificarestudiantepreicfes', array('id' => $username)));
                    }
                }
                return $this->render('FundeuisUsuariosBundle:Administrar:Modificar.html.twig', array('usuario' => $usuario, 'departamentos' => $departamento, 'id' => $id, 'formUsuario' => $formUsuario->createView()));
            } elseif ($value == 'ROLE_ADMINISTRADOR') {
                return $this->render('FundeuisUsuariosBundle:Administrar:Modificar.html.twig');
            }
        }
    }

    /*
     * Recibe el id, correspondiente al numero de documento de identidad del usuario. 
     * Crear estudiante preicfes
     */

    public function ModificarestudiantepreicfesAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $departamento = new Departamento();
        $departamento = $em->getRepository('FundeuisUsuariosBundle:Departamento')->findAll();
        $redimencionarImagen = new RedimencionarImagen();
        $estudiantePreIcfes = new Estudiantepreicfes();
        $usuario = $em->getRepository('FundeuisUsuariosBundle:Usuario')->findOneBy(array('numerodocumentoidentidad' => $id));
        $estudiantePreIcfes = $em->getRepository('FundeuisUsuariosBundle:Estudiantepreicfes')->findOneBy(array('usuario' => $usuario->getIdusuario()));
        $formEstudiantesPreIcfes = $this->createForm(new EstudiantepreicfesType(), $estudiantePreIcfes);
        echo $usuario->getIdusuario();
        if ($request->getMethod() == 'POST') {
            $formEstudiantesPreIcfes->handleRequest($request);
            $u = $request->request->get('listaUniversidad');
            $c = $request->request->get('listaColegio');

            if ($formEstudiantesPreIcfes->isValid()) {


                if ($c) {
                    $colegio = $em->getRepository('FundeuisUsuariosBundle:Colegio')->find($c);
                    $estudiantePreIcfes->setColegio($colegio);
                }
                if ($u) {
                    $universidad = $em->getRepository('FundeuisUsuariosBundle:Universidad')->find($u);
                    $estudiantePreIcfes->setUniversidad($universidad);
                }

                $foto = $formEstudiantesPreIcfes->get('archivo')->getData();

                if ($foto) {
                    $ano = \date('Y');
                    $dir = 'images/foto/' . $ano . '/';
                    //$nombreArchivo = rand(10000, 99999);
                    $nombreArchivo = $usuario->getUser()->getEmail();
                    $extension = $foto->guessExtension();
                    if ($extension && ($extension == "JPG" || $extension == "JPeG" || $extension == "jpeg" || $extension == "jpg")) {
                        $estudiantePreIcfes->setFoto($dir . $nombreArchivo . '.' . "jpg"); //Instancia del modelo Produccionintelectual, nombre 
                        $foto->move($dir, $nombreArchivo . '.' . "jpg"); //Mover el archivo al directorio
                        $redimencionarImagen->redimencionar($estudiantePreIcfes->getFoto(), $dir);
                    }
                }

                $em->persist($estudiantePreIcfes);
                $em->flush($estudiantePreIcfes);
                return $this->redirect($this->generateURL('fundeuis_usuarios_buscar'));
            }
        }
        return $this->render('FundeuisUsuariosBundle:Administrar:Modificarestudiantepreicfes.html.twig', array('departamentos' => $departamento, 'id' => $id, 'formEstudiantePreIcfes' => $formEstudiantesPreIcfes->createView(), 'estudiantepreicfes' => $estudiantePreIcfes));
    }

    public function EliminarAction($id) {
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FundeuisUserBundle:User')->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateURL('fundeuis_usuarios_buscar'));
    }

    public function BuscarAction($parametro, $limite) {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $usuario = $em->getRepository('FundeuisUsuariosBundle:Usuario')->findBy(array(), array('idusuario' => 'DESC'), $limite);
        return $this->render('FundeuisUsuariosBundle:Administrar:Buscar.html.twig', array('usuarios' => $usuario, 'limite' => $limite));
    }

    public function VerestudiantepreicfesAction($id) {
        $estudiantePreIcfes = new Estudiantepreicfes();
        $em = $this->getDoctrine()->getManager();
        $estudiantePreIcfes = $em->getRepository('FundeuisUsuariosBundle:Estudiantepreicfes')->findOneBy(array('usuario' => $id));
        return $this->render('FundeuisUsuariosBundle:Administrar:Verestudiantepreicfes.html.twig', array('id' => $id, 'estudiante' => $estudiantePreIcfes));
    }

}
