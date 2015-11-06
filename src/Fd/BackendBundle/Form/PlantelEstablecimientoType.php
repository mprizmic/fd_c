<?php

namespace Fd\BackendBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlantelEstablecimientoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();

        //combo de localizaciones
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            $optionsEstablecimiento = array(
                'required' => true,
                'label' => 'Establecimiento',
                'class' => 'EstablecimientoBundle:EstablecimientoEdificio',
                'query_builder' => function(EntityRepository $er) {
                    return $er->qbAllOrdenado();
                });

            $optionsDependencia = array(
                'required' => true,
                'class' => 'TablaBundle:Dependencia',
                'label' => 'Dependencia',
            );

            if ($data->getId()) {
                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsEstablecimiento['disabled'] = true;

                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsDependencia['disabled'] = true;
            };

            $form->add(
                    $factory->createNamed('establecimiento', 'entity', null, $optionsEstablecimiento));

            $form->add(
                    $factory->createNamed('dependencia', 'entity', null, $optionsDependencia));
        });

        $builder
                ->add('te', null, array(
                    'required' => false,
                    'label'=>'Teléfono',
                ))
                ->add('email', null, array(
                    'required' => false,
                    'label'=>'Email',
                ))
        ;

    }

    public function getName() {
        return 'backend_organizacioninterna_type';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento',
        ));
    }
}
