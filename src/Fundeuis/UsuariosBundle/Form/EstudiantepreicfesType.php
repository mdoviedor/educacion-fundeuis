<?php

namespace Fundeuis\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudiantepreicfesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombresacudiente', 'text', array(
                    'label' => '* Nombres del Acudiente:',
                    'attr' => array('class' => 'form-control')))
                ->add('apellidosacudiente', 'text', array(
                    'label' => '* Apellidos del Acudiente:',
                    'attr' => array('class' => 'form-control')))
                ->add('telefonofijoacudiente', 'text', array(
                    'label' => 'Teléfono fijo acudiente:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')))
                ->add('telefonocelularacudiente', 'text', array(
                    'label' => 'Teléfono celular acudiente:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')))
                ->add('foto', 'file', array(
                    'required' => false,
                    'data_class' => null,
                    'label' => 'Foto:',
                    'attr' => array('class' => 'form-control')
                ))
//                    ->add('usuario')
                ->add('conocimientocursos', 'entity', array(
                    'class' => 'FundeuisUsuariosBundle:Conocimientocursos',
                    'property' => 'nombre',
                    'label'=>'* ¿Cómo conoció fundeuis?',
                    'attr' => array('class' => 'form-control')
                ))
               
//                ->add('colegio')
//                ->add('universidad')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fundeuis\UsuariosBundle\Entity\Estudiantepreicfes'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'fundeuis_usuariosbundle_estudiantepreicfes';
    }

}
