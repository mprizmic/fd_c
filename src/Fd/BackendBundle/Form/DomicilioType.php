<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EdificioBundle\Repository\EdificioRepository;

class DomicilioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('calle', 'text', array('trim' => true))
                ->add('altura', 'text', array('trim' => true))
                ->add('c_postal', 'text', array(
                    'trim' => true,
                    'required' => false,
                ))
                ->add('principal', 'checkbox', array('required' => FALSE))
                ->add('edificio', 'entity', array(
                    'class' => 'EdificioBundle:Edificio',
                    'query_builder' => function (EdificioRepository $repository) {
                        $qb = $repository->qbAllOrdenado();
                        return $qb;
                    },
                    'help' => 'Edificio al que pertenece este domicilio',
                ))
        ;
    }

    public function getName() {
        return 'fd_edificiobundle_domiciliotype';
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Fd\EdificioBundle\Entity\Domicilio',
        );
    }

}
