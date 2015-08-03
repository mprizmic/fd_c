<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EdificioBundle\Repository\EdificioRepository;

class VecinoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', null, array(
                    'attr' => array(
                        'class' => 'input_talle_5'
                    ),
                ))
                ->add('edificio', 'entity', array(
                    'class' => 'Fd\EdificioBundle\Entity\Edificio',
                    'query_builder' => function (EdificioRepository $repository) {
                        return $repository->qbAllOrdenado();
                    },
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EdificioBundle\Entity\Vecino'
        ));
    }

    public function getName() {
        return 'vecino_type';
    }

}
