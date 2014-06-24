<?php

namespace Fundeuis\InscripcionpreicfesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioCursoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estado')
            ->add('rutaarchivo')
            ->add('nombrearchivo')
            ->add('curso')
            ->add('usuario')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fundeuis\InscripcionpreicfesBundle\Entity\UsuarioCurso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fundeuis_inscripcionpreicfesbundle_usuariocurso';
    }
}
