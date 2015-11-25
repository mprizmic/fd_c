<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Repository\EstablecimientoEdificioRepository;
use Fd\EstablecimientoBundle\Repository\PlantelEstablecimientoRepository;

class AutoridadType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'required' => false,
                ))
                ->add('apellido')
                ;
        
        $factory = $builder->getFormFactory();
        
        //declaración del suscriptor que agrega el campo cargo
        $cargoSubscriber = new AddCargoFieldSubscriber($factory);
        
        //se agrega la suscripción al evento
        $builder->addEventSubscriber($cargoSubscriber);
        
        $establecimientoSubscriber = new AddEstablecimientoFieldSubscriber($factory);
        
        $builder->addEventSubscriber($establecimientoSubscriber);
        
        
        
                ->add('establecimiento', 'entity', array(
                    'required' => true,
                    'empty_value' => 'Seleccione...',
                    'class' => 'EstablecimientoBundle:EstablecimientoEdificio',
                    'mapped' => false,
                    'query_builder' => function(EstablecimientoEdificioRepository $repository) {
                        $qb = $repository->qbSedesYAnexosOrdenados();
                        return $qb;
                    }
                ))
                ->add('cargo', 'entity', array(
                    'label' => 'Cargo',
                    'empty_value' => 'Seleccione...',
                    'class' => 'EstablecimientoBundle:PlantelEstablecimiento',
                    'query_builder' => function (PlantelEstablecimientoRepository $repository) {
                        $qb = $repository->qbAllOrdenado();
                        return $qb;
                    },
                ))
//                ->add('establecimiento')
                            
                            
                            
                $builder->add('inicio_mandato', 'date', array(
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
    }

    public function getName() {
        return 'autoridad_type';
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\TablaBundle\Entity\Autoridad',
        ));
    }
}
