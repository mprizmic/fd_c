<?php

namespace Fd\BackendBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\MediaOrientaciones;

class MediaOrientacionesFilterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('nombre', 'filter_text', array(
            'condition_pattern' => 4,
            'attr' => array(
                'class' => 'input_talle_4',
            ),
        ));
    }

    public function getName() {
        return 'mediaorientaciones_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}