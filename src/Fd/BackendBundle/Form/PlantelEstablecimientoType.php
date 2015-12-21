<?php

namespace Fd\BackendBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\BackendBundle\EventListener\AddEstablecimientoFieldPlantelSubscriber;
use Fd\BackendBundle\EventListener\AddOrganizacionFieldPlantelSubscriber;
use Fd\TablaBundle\Entity\Cargo;
use Fd\TablaBundle\Repository\CargoRepository;

class PlantelEstablecimientoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();

        $establecimientoSubscriber = new AddEstablecimientoFieldPlantelSubscriber($factory);
        $builder->addEventSubscriber($establecimientoSubscriber);

        $organizacionSubscriber = new AddOrganizacionFieldPlantelSubscriber($factory);
        $builder->addEventSubscriber($organizacionSubscriber);

        $builder
                ->add('cargo', 'entity', array(
                    'empty_value' => 'Cargo...',
                    'class' => 'TablaBundle:Cargo',
                    'label' => 'Cargo',
                    'query_builder' => function (EntityRepository $repository) {
                        $qb = $repository->qyAllOrdenado();
                        return $qb;
                    }
                ))
                ->add('te', null, array(
                    'required' => false,
                    'label' => 'Teléfono',
                ))
                ->add('email', null, array(
                    'required' => false,
                    'label' => 'Email',
                ))
        ;
    }

    public function getName() {
        return 'backend_plantelestablecimiento_type';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento',
        ));
    }

}
