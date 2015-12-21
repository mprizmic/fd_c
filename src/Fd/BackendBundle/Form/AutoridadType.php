<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Repository\EstablecimientoEdificioRepository;
use Fd\EstablecimientoBundle\Repository\PlantelEstablecimientoRepository;
use Fd\BackendBundle\EventListener\AddEstablecimientoFieldSubscriber;
use Fd\BackendBundle\EventListener\AddOrganizacionFieldSubscriber;
use Fd\BackendBundle\EventListener\AddPlantelFieldSubscriber;

class AutoridadType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {



        $builder
                ->add('nombre', 'text', array(
                    'required' => false,
                ))
                ->add('apellido')
                ->add('inicio_mandato', 'date', array(
                    'label' => 'Fecha de inicio del mandato',
                    'required' => false,
                ))
                ->add('te_particular', 'text', array(
                    'required' => false,
                ))
                ->add('celular', 'text', array(
                    'required' => false,
                ))
                ->add('email', 'email', array(
                    'required' => false,
                    'attr' => array('class' => 'input_talle_4'),
                    'help' => 'Un email válido',
                ))
        ;
        $factory = $builder->getFormFactory();

        $establecimientoSubscriber = new AddEstablecimientoFieldSubscriber($factory);
        $builder->addEventSubscriber($establecimientoSubscriber);

        $organizacionSubscriber = new AddOrganizacionFieldSubscriber($factory);
        $builder->addEventSubscriber($organizacionSubscriber);

        //declaración del suscriptor que agrega el campo cargo
        $cargoSubscriber = new AddPlantelFieldSubscriber($factory);
        $builder->addEventSubscriber($cargoSubscriber);
    }

    public function getName() {
        return 'autoridad_type';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\Autoridad',
        ));
    }

}
