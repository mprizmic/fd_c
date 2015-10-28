<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\TablaBundle\Entity\Dependencia;
use Fd\TablaBundle\Repository\DependenciaRepository;

class DependenciaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();

        $builder
                ->add('nombre', 'text', array('trim' => true))
                ->add('codigo', 'text', array(
                    'trim' => true,
                    'label' => 'Código',
                    ))
                ->add('orden', 'number')
        ;

    }

    public function getName() {
        return 'fd_backendbundle_dependenciatype';
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Fd\TablaBundle\Entity\Dependencia',
        );
    }

}
