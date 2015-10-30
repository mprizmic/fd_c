<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganizacionInternaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

                ->add('')

        ;
    }

    public function getName() {
        return 'organizacioninterna_type';
    }

}
