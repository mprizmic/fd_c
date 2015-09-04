<?php

namespace Fd\TablaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FraseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('frase', 'textarea', array(
                    'attr' => array(
                        'rows' => 4,
                        'cols' => 100,
                    ),
                    'trim' => true,
                ))
                ->add('fecha', 'date', array(
                    'years' => range(2000, 2037),
                ))
                ->add('autor')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\TablaBundle\Entity\Frase'
        ));
    }

    public function getName() {
        return 'fd_tablabundle_frasetype';
    }

}
