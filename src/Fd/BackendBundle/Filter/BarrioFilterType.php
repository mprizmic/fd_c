<?php

namespace Fd\BackendBundle\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BarrioFilterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'filter_text')
                ->add('abreviatura', 'filter_text')
        ;
    }

    public function getName() {
        return 'fd_tablabundle_barriofiltertype';
    }

}
