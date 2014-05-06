<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OfertaEducativaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carrera')
            ->add('normas')
        ;
    }

    public function getName()
    {
        return 'fd_ofertaeducativabundle_ofertaeducativatype';
    }
}
