<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SecundarioXType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('unidad_oferta')
                ->add('anio_inicio')
                ->add('matricula')
        ;
    }

    public function getName() {
        return 'secundariox_type';
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\SecundarioX',
        ));
    }

}
