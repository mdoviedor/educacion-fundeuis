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

    public function CrearAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $u = $userManager->createUser();
        $usuario = new Usuario();
        $departamento = new Departamento();
        $departamento = $em->getRepository('FundeuisUsuariosBundle:Departamento')->findAll();

        $redimencionarImagen = new RedimencionarImagen();
        $estudiantePreIcfes = new Estudiantepreicfes();

        $formEstudiantesPreIcfes = $this->createForm(new EstudiantepreicfesType(), $estudiantePreIcfes);
        $formUsuario = $this->createForm(new UsuarioType(), $usuario);

        if ($request->getMethod() == 'POST') {
            $formUsuario->handleRequest($request);
            $formEstudiantesPreIcfes->handleRequest($request);

            if ($formUsuario->isValid() && $formEstudiantesPreIcfes->isValid()) {
                $foto = $formEstudiantesPreIcfes->get('foto')->getData();
                if ($foto) {
                    $dir = 'images/fotos/';
                    $nombreArchivo = rand(10000, 99999);
                    $extension = $foto->guessExtension();
                    if ($extension && ($extension == "JPG" || $extension == "JPeG" || $extension == "jpeg" || $extension == "jpg")) {
                        $estudiantePreIcfes->setFoto($dir . $nombreArchivo . '.' . "jpg"); //Instancia del modelo Produccionintelectual, nombre 
                        $foto->move($dir, $nombreArchivo . '.' . "jpg"); //Mover el archivo al directorio
                        $redimencionarImagen->redimencionar($foto, $dir);
                    }
                }
                $email = $formUsuario->get('correoelectronico')->getData();
                $username = $formUsuario->get('numerodocumentoidentidad')->getData();
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setEnabled(true);
                $user->setPlainPassword($username);
                $user->r('ROLE_USUARIO');

                $userManager->updateUser($user); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush(); //Guarda en la base de datos U

                $usr = $em->getRepository('FundeuisUserBundle:User')->findOneBy(array('username' => $username));
                $usuario->setUser($usr);

                $em->persist($usuario);
                $em->flush($usuario);

                $estudiantePreIcfes->setUsuario($usuario);

                $em->persist($estudiantePreIcfes);
                $em->flush($estudiantePreIcfes);
            }
        }
        return $this->render('FundeuisUsuariosBundle:Administrar:crear.html.twig', array('formUsuario' => $formUsuario->createView(), 'departamentos' => $departamento, 'formEstudiantePreIcfes' => $formEstudiantesPreIcfes->createView()));
    }

    public function ModificarAction() {
        
    }

    public function EliminarAction() {
        
    }

    public function BuscarAction() {
        
    }

}
