<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DisciplinaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('codigo', null, array(
                    'label' => 'Código',
                ))
                ->add('descripcion', null, array(
                    'label' => 'Descripción'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Disciplina'
        ));
    }

    public function getName() {
        return 'fd_disciplina_type';
    }

}
