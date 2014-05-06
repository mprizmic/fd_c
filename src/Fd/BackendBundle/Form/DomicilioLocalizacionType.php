<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DomicilioLocalizacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('principal')
            ->add('domicilio')
            ->add('localizacion')
        ;
    }

    public function getName()
    {
        return 'fd_edificiobundle_domiciliolocalizaciontype';
    }
}
