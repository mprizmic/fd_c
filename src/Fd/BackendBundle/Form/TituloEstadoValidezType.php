<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\OfertaEducativaBundle\Entity\Titulo;

class TituloEstadoValidezType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('el_titulo')
            ->add('estado_validez')
            ->add('fecha_estado_validez')
            ->add('validez_desde')
            ->add('validez_hasta')
        ;
    }

    public function getName()
    {
        return 'tituloestadovalidez_type';
    }
}
