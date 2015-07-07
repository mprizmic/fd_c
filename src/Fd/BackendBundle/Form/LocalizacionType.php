<?php

namespace Fd\BackendBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Repository\UnidadEducativaRepository;

class LocalizacionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();
        /*
         * si el rgistro ya está creado no se pueden cambiar el nivel y el establecimiento
         * si es un registro nuevo el campo està disponible para cargarlo
         */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            $optionsUnidadEducativa = array(
                'required' => true,
                'label' => 'Unidad educativa del establecimiento',
                'class' => 'EstablecimientoBundle:UnidadEducativa',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('ue');
                });

            if ($data->getId()) {
                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsUnidadEducativa['disabled'] = true;
            };

            $form->add(
                    $factory->createNamed('unidad_educativa', 'entity', null, $optionsUnidadEducativa));
        });
        $builder
                ->add('establecimiento_edificio', null, array(
                    'required' => true,
                    'label' => 'Edificio del establecimiento (sede o anexo)',
                ))
                ->add('matricula', 'number', array(
                    'label' => 'Matrícula',
                    'required' => false,
                    'attr' => array(
                        'class' => 'input_talle_05',
                    ),
                ))
        ;
    }

    public function getName() {
        return 'fd_establecimientobundle_localizaciontype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\Localizacion',
        ));
    }

}
