<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BarrioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('abreviatura', null, array(
                    'attr' => array(
                        'class' => 'input_talle_05',
                    )
                ))
        ;
    }

    public function getName() {
        return 'barrio_type';
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Fd\TablaBundle\Entity\Barrio',
        );
    }

}
