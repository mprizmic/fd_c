<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UnidadOfertaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('unidades')
            ->add('ofertas')
        ;
    }

    public function getName()
    {
        return 'fd_establecimientobundle_unidadofertatype';
    }
}
