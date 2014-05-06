<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrientacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('titulo')
            ->add('duracion')
            ->add('carrera')
        ;
    }

    public function getName()
    {
        return 'fd_ofertaeducativabundle_orientaciontype';
    }
}
