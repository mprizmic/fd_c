<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CargoAutoridadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('abreviatura')
        ;
    }

    public function getName()
    {
        return 'fd_tablabundle_cargoautoridadtype';
    }
}
