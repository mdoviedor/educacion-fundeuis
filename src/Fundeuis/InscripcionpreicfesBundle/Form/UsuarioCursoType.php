<?php

namespace Fundeuis\InscripcionpreicfesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioCursoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('estado', 'choice', array(
                    'label' => '* Estado:',
//                    'attr' => array('class' => 'form-control'),
                    'choices' => array(false => 'No', true => 'Si'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true))
//                ->add('rutaarchivo')
//                ->add('nombrearchivo')
//                ->add('curso', 'entity', array(
//                    'class' => 'FundeuisInscripcionpreicfesBundle:Curso',
//                    'property' => 'nombreCurso',
//                    'query_builder' => function(\GS\ProyectosBundle\Entity\TemaRepository $er) {
//                return $er->createQueryBuilder('u')
//                        ->where('u.estado = true');
//            },
//                ))
//                ->add('usuario')
                ->add('archivo', 'file', array(
                    'required' => true,
                    // 'data_class' => null,
                    'mapped' => false,
                    'label' => 'Documentos:',
                    'attr' => array('class' => 'form-control')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fundeuis\InscripcionpreicfesBundle\Entity\UsuarioCurso'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'fundeuis_inscripcionpreicfesbundle_usuariocurso';
    }

}
