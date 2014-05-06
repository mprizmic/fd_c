<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocalizacionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('unidad_educativa', null, array(
                    'required' => true,
                    'label' => 'Nivel o unidad educativa del establecimiento'))
                ->add('establecimiento_edificio', null, array(
                    'required' => true,
                    'label' => 'Edificio del establecimiento (sede o anexo)',
                ))
//            ->add('domicilio')
        ;
    }

    public function getName() {
        return 'fd_establecimientobundle_localizaciontype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\Localizacion',
        ));
    }

}
