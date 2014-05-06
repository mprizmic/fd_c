<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GlosarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('termino')
            ->add('descripcion')
        ;
    }

    public function getName()
    {
        return 'fd_tablabundle_glosariotype';
    }
}
