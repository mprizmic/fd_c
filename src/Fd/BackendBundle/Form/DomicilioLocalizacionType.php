<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DomicilioLocalizacionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('domicilio')
                ->add('localizacion', null, array(
                    'label' => 'Localización',
                ))
                ->add('principal', null, array(
                    'label' => 'Domicilio principal',
                ))
        ;
    }

    public function getName() {
        return 'fd_edificiobundle_domiciliolocalizaciontype';
    }

}
