<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\TituloCarrera;
use Fd\TablaBundle\Entity\EstadoCarrera;

class UnTituloType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'label' => ' ',
                    'required' => FALSE,
                    'attr' => array(
                        'class'=>'input_talle_4',
                        'cols' => 40,
                        'ancho' => 28,
                        'descripcion' => 'Nombre',
                    )
                ))
                ->add('estado', 'entity', array(
                    'class' => 'TablaBundle:EstadoCarrera',
                    'label' => ' ',
                    'required' => FALSE,
                    'attr' => array(
                        'cols' => 40,
                        'ancho' => 5,
                        'descripcion' => 'Estado',
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\TituloCarrera',
        ));
    }

    public function getName() {
        return 'un_titulocarrera_type';
    }

}