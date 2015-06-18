<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UnEdificioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cui', 'entity', array(
                    'label' => '',
                    'class' => 'Fd\EdificioBundle\Entity\Edificio',
                    'property' => 'domicilioPrincipal',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EdificioBundle\Entity\Edificio'
        ));
    }

    public function getName() {
        return 'fd_edificiobundle_unedificiotype';
    }

}
