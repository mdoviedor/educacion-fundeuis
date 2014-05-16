<?php

namespace Fundeuis\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('numerodocumentoidentidad', 'repeated', array(
                    'type' => 'text',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => true,
                    'first_options' => array(
                        'label' => '* Documento Identidad:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Documento Identidad:',
                        'attr' => array('class' => 'form-control'))))
                ->add('correoElectronico', 'repeated', array(
                    'mapped' => false,
                    'type' => 'email',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => true,
                    'first_options' => array(
                        'label' => '* Correo electrónico:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Correo electrónico:',
                        'attr' => array('class' => 'form-control'))))
                ->add('primernombre', 'text', array(
                    'label' => '* Primer Nombre:',
                    'attr' => array('class' => 'form-control')))
                ->add('segundonombre', 'text', array(
                    'label' => 'Segundo Nombre:',
                    'required'=>false,
                    'attr' => array('class' => 'form-control')))
                ->add('primerapellido', 'text', array(
                    'label' => '* Primer Apellido:',
                    'attr' => array('class' => 'form-control')))
                ->add('segundoapellido', 'text', array(
                    'label' => '* Segundo Apellido:',
                    'attr' => array('class' => 'form-control')))
                ->add('telefonofijo', 'text', array(
                    'required'=>false,
                    'label' => 'Teléfono fijo:',
                    'attr' => array('class' => 'form-control')))
                ->add('telefonocelular', 'text', array(
                    'label' => 'Teléfono Celular:',
                    'required'=>false,
                    'attr' => array('class' => 'form-control')))          
                ->add('tipodocumentoidentidad', 'entity', array(
                    'class' => 'FundeuisUsuariosBundle:Tipodocumentoidentidad',
                    'property' => 'nombre',
                    'label' => '* Tipo Documento Identidad:',
                    'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fundeuis\UsuariosBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'fundeuis_usuariosbundle_usuario';
    }

}
