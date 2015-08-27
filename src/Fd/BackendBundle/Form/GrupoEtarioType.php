<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GrupoEtarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('codigo', null, array(
                    'label' => 'Código',
                    'required' => true,
                ))
                ->add('descripcion', null, array(
                    'label' => 'Descripción',
                    'required' => true,
                ))
                ->add('orden', null, array(
                    'required' => false,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\TablaBundle\Entity\GrupoEtario'
        ));
    }

    public function getName() {
        return 'fd_tablabundle_grupoetariotype';
    }

}
