<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EspecializacionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titulo', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_5',
                    ),
                    'required' => false,
                ))
                ->add('nombre', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_5',
                    ),
                ))
                ->add('duracion')
                ->add('estado')
                ->add('tipo_especializacion')
                ->add('ultima_cohorte_valida', 'integer', array(
                    'required' => false,
                    'help' => 'Ingrese al año de la última cohorte para la cual la especialización está habilitada',
                    'label' => 'Última cohorte',
                    'attr' => array(
                        'class' => 'input_talle_05',
                    ),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Especializacion'
        ));
    }

    public function getName() {
        return 'fd_especializacion_type';
    }

}
