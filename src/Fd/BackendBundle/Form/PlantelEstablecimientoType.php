<?php

namespace Fd\BackendBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Repository\OrganizacionInternaRepository;
use Fd\TablaBundle\Entity\Cargo;
use Fd\TablaBundle\Repository\CargoRepository;

class PlantelEstablecimientoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();

        //combo de localizaciones
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            $optionsOrganizacion = array(
                'required' => true,
                'label' => 'Dependencia del establecimiento',
                'class' => 'EstablecimientoBundle:OrganizacionInterna',
                'query_builder' => function(EntityRepository $er) {
                    return $er->qbAllOrdenado();
                });

            $optionsCargo = array(
                'required' => true,
                'class' => 'TablaBundle:Cargo',
                'label' => 'Cargo',
            );

            if ($data->getId()) {
                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsOrganizacion['disabled'] = true;

                //si el registro ya está creado no se pueden cambiar ni la unidad educativa ni el establecimeinto
                $optionsCargo['disabled'] = true;
            };

            $form->add(
                    $factory->createNamed('cargo', 'entity', null, $optionsCargo));
            $form->add(
                    $factory->createNamed('organizacion', 'entity', null, $optionsOrganizacion));

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
        return 'backend_plantelestablecimiento_type';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento',
        ));
    }
}
