<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\Sala;
use Fd\TablaBundle\Entity\GrupoEtario;
use Fd\TablaBundle\Repository\GrupoEtarioRepository;

class SalaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('grupo_etario', 'entity', array(
                    'required' => true,
                    'class' => 'Fd\TablaBundle\Entity\GrupoEtario',
                    'empty_value' => 'Seleccione...',
                    'query_builder' => function(GrupoEtarioRepository $er) {
                        return $er->createQueryBuilder('ge')->orderBy('ge.orden', 'ASC');
                    },
                    'label' => ' ',
                    'attr' => array(
                        'ancho' => 10,
                        'descripcion' => 'Edad de la sala',
                    ),
                ))
                ->add('q_secciones', 'integer', array(
                    'label' => ' ',
                    'attr' => array(
                        'class' => 'input_talle_05',
                        'descripcion' => 'Cant.secciones',
                        'ancho' => 3,
                    ),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Sala',
        ));
    }

    public function getName() {
        return 'sala_type';
    }

}
