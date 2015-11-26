<?php

namespace Fd\BackendBundle\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;

/**
 * Agrega el campo establecimiento que es un combo para seleccionar la sede/anexo.
 * El dato no esta mapeado a ninguna entidad
 */
class AddEstablecimientoFieldSubscriber implements EventSubscriberInterface {

    private $factory;

    public function __construct(FormFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND => 'preBind'
        );
    }

    private function addEstablecimientoForm($form, $establecimiento) {
        $form->add($this->factory->createNamed('establecimientos', 'entity', $establecimiento, array(
                    'label'=>'Establecimiento',
                    'mapped' => false,
                    'class' => 'EstablecimientoBundle:EstablecimientoEdificio',
                    'empty_value' => 'Establecimiento ...',
                    'query_builder' => function (EntityRepository $repository) {
                        $qb = $repository->qbSedesYAnexosOrdenados();
                        return $qb;
                    }
        )));
    }

    public function preSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }
        
        $cargo = $data->getCargo();
        $establecimiento = ($cargo) ? $cargo->getOrganizacion()->getEstablecimiento() : null;
        $this->addEstablecimientoForm($form, $establecimiento);
    }

    public function preBind(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $establecimiento = array_key_exists('establecimientos', $data) ? $data['establecimientos'] : null;
        $this->addEstablecimientoForm($form, $establecimiento);
    }

}
