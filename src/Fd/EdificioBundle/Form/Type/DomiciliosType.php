<?php

/**
 * se utiliza para asignar los registros de DomicilioLocalizacion en la página de localizaciones
 */

namespace Fd\EdificioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DomiciliosType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('domicilios', 'collection', array(
            'type' => new UnDomicilioType(),
        ));
        //esta función verifica que no estén todos los domicilios tildados como desasignados
        //siempre tiene que quedar al meno un domicilio sin desasignar
        $builder->addEventListener(FormEvents::POST_BIND, function(DataEvent $event) {
                    $form = $event->getForm();

                    $datos = $form->getData();

                    $domicilios = $datos['domicilios'];
                    $al_menos_uno_tildado = false;
                    foreach ($domicilios as $domicilio) {
                        if ($domicilio['flag']) {
                            $al_menos_uno_tildado = true;
                        };
                    };
                    if (!$al_menos_uno_tildado) {
                        $form->addError(new FormError('No puede desasignar todos los domicilios.'));
                    };
                }
        );
    }

    public function getName() {
        return 'domicilios_type';
    }

}
