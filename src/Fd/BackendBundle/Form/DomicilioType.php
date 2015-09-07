<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Fd\EdificioBundle\Entity\Edificio;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EdificioBundle\Repository\EdificioRepository;

class DomicilioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();

        $builder
                ->add('calle', 'text', array('trim' => true))
                ->add('altura', 'text', array('trim' => true))
                ->add('c_postal', 'text', array(
                    'trim' => true,
                    'required' => false,
                ))
        ;

        /**
         * si se está editando un registro existente se edita el edificio al que pertenece
         */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            //si el registro no está creado no se agrega el campo del edificio
            if ($data->getId()) {
                $form->add(
                        $factory->createNamed('edificio', 'entity', null, array(
                            'class' => 'EdificioBundle:Edificio',
                            'query_builder' => function (EdificioRepository $repository) {
                                $qb = $repository->qbAllOrdenado();
                                return $qb;
                            },
                            'help' => 'Edificio al que pertenece este domicilio',
                            'empty_value' => 'Seleccione...',
                            'required' => false,
                )));

                /**
                 * si el domicilio se está editando y tiene un edificio, se puede determinar si es domicilio principal o no
                 */
                $form->add(
                        $factory->createNamed('principal', 'checkbox', null, array('required' => FALSE)));
            };
        });
    }

    public function getName() {
        return 'fd_edificiobundle_domiciliotype';
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Fd\EdificioBundle\Entity\Domicilio',
        );
    }

}
