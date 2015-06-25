<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UnEdificioType extends AbstractType {

    private $combo_edificios;

    public function __construct($combo_edificios) {
        $this->combo_edificios = $combo_edificios;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('combo_edificios', 'choice', array(
                    'required'=>false,
                    'label' => ' ',
                    'choices' => $this->combo_edificios,
                    'empty_value' => 'Seleccione...',
                    'attr' => array(
                        'class' => 'input_talle_4',
            )))
        ;
    }

//    public function setDefaultOptions(OptionsResolverInterface $resolver) {
//        $resolver->setDefaults(array(
////            'data_class' => 'Fd\EdificioBundle\Entity\Edificio'
//        ));
//    }

    public function getName() {
        return 'fd_edificiobundle_unedificiotype';
    }

}
