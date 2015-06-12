<?php

namespace Fd\BackendBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Form\Type\UnidadOfertaTurnoType;
use Fd\EstablecimientoBundle\Repository\LocalizacionRepository;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Repository\OfertaEducativaRepository;

class UnidadOfertaType extends AbstractType {

    /**
     * Si estoy editando un registro existente, la localización y la oferta educativa no se pueden cambiar
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();

        //combo de localizaciones
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            $optionsLocalizacion = array(
                'required' => true,
                'label' => 'Localización',
                'class' => 'EstablecimientoBundle:Localizacion',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('l');
                });

            if ($data->getId()) {
                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsLocalizacion['disabled'] = true;
            };

            $form->add(
                    $factory->createNamed('localizacion', 'entity', null, $optionsLocalizacion));
        });

        //combo de ofretas educativas
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            $optionsOfertaEducativa = array(
                'required' => true,
                'class' => 'OfertaEducativaBundle:OfertaEducativa',
                'label' => 'Oferta Educativa',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('l');
//                },
            );

            if ($data->getId()) {
                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsOfertaEducativa['disabled'] = true;
            };

            $form->add(
                    $factory->createNamed('ofertas', 'entity', null, $optionsOfertaEducativa));
        });
        $builder
                ->add('turnos', 'collection', array(
                    'type' => new UnidadOfertaTurnoType(),
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                ))
        ;
    }

    public function getName() {
        return 'fd_establecimientobundle_unidadofertatype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\UnidadOferta',
        ));
    }

}
