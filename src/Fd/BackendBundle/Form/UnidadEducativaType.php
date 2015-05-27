<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\TurnoUnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\BackendBundle\Form\TurnoUnidadEducativaType;

class UnidadEducativaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();
        /*
         * si el rgistro ya está creado no se pueden cambiar ni el nivel ni el establecimiento
         * si es un registro nuevo los 2 campos estàn disponibles para cargarlos 
         */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

                    $form = $event->getForm();
                    $data = $event->getData();

                    $optionsNivel = array(
                        'class' => 'TablaBundle:Nivel',
                        'empty_value' => 'Seleccione...',
                        'multiple' => false,
                        'property'=>'nombre',
                        'expanded' => false,
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('n')->orderBy('n.orden', 'ASC');
                        });

                    $optionsEstablecimientos = array(
                        'class' => 'EstablecimientoBundle:Establecimiento',
                        'empty_value' => 'Seleccione...',
                        'multiple' => false,
                        'expanded' => false,
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('e')->orderBy('e.orden', 'ASC');
                        });


                    if ($data->getId()) {
                        //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                        $optionsNivel['disabled'] = true;
                        $optionsEstablecimientos['disabled'] = true;
                    };

                    $form->add(
                            $factory->createNamed('nivel', 'entity', null, $optionsNivel));
                    $form->add(
                            $factory->createNamed('establecimiento', 'entity', null, $optionsEstablecimientos));
                });

        $builder
                ->add('descripcion', 'text', array(
                    'label' => 'Descripción',
                ))
                //por el momento no se usan. Se agrega la tabla autoridades y se le asocia un establecimiento
//                ->add('nombre_autoridad')
//                ->add('cargo_autoridad')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\UnidadEducativa',
        ));
    }

    public function getName() {
        return 'fd_unidadeducativa_type';
    }

}
