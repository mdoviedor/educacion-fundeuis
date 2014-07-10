<?php

namespace Fundeuis\InscripcionpreicfesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CursoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $ahora = \date('Y');
        $builder
                ->add('fechainicio', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'years' => range($ahora - 3, $ahora + 5),
                    'label' => '* Fecha de inicio:'
                ))
                ->add('fechafin', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'years' => range($ahora, $ahora + 5),
                    'label' => '* Fecha de finalización:'
                ))
                ->add('duracion', 'text', array(
                    'label' => '* Duración en horas:',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('horainicio', 'time', array(
                    'label' => '* Hora de inicio:',
                ))
                ->add('horafin', 'time', array(
                    'label' => '* Hora de finalización:',
                ))
                ->add('intensidadhoraria', 'text', array(
                    'label' => '* Intesidad horaria:',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('descripcion', 'textarea', array(
                    'label' => '* Descripción:',
                    'attr' => array('class' => 'form-control')))
                ->add('nombrecurso', 'entity', array(
                    'class' => 'FundeuisInscripcionpreicfesBundle:Nombrecurso',
                    'property' => 'nombre',
                    'label' => '* Nombre del curso:',
                    'attr' => array('class' => 'form-control')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fundeuis\InscripcionpreicfesBundle\Entity\Curso'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'fundeuis_inscripcionpreicfesbundle_curso';
    }

}
