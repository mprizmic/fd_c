<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class EdificioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cui')
                ->add('referencia')
                ->add('superficie')
                ->add('comuna')
                ->add('cgp')
                ->add('barrio', 'entity', array(
                    'class' => 'TablaBundle:Barrio',
                    'empty_value' => 'Seleccione...',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('b')->orderBy('b.nombre', 'ASC');
                    },))
                ->add('distritoEscolar', 'entity', array(
                    'label' => 'Distrito escolar',
                    'class' => 'TablaBundle:DistritoEscolar',
                    'empty_value' => 'Seleccione...',
                ))
                ->add('inspector')
        ;
    }

    public function getName() {
        return 'fd_edificio_type';
    }

}

