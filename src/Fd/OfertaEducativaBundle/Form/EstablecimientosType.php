<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstablecimientosType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('establecimientos','collection', array(
            'type'=>new UnEstablecimientoType(),
        ));
    }
    public function getName() {
        return 'establecimientos_type';
    }

}
