<?php

namespace Fd\BackendBundle\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
//use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;
use Fd\EstablecimientoBundle\Repository\PlantelEstablecimientoRepository;

/**
 * Agrega el campo cargo al tipo que es un combo para seleccionar el cargo que en realidad es
 * un registro de plantel_establecimiento
 */
class AddPlantelFieldSubscriber implements EventSubscriberInterface {

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

    private function addPlantelForm($form, $organizacion) {
        //cargo es el nombre del campo de la tabla autoridad. 
        // es un objeto plantel_establecimiento
        $form->add($this->factory->createNamed('cargo', 'entity', null, array(
                    'class' => 'EstablecimientoBundle:PlantelEstablecimiento',
                    'empty_value' => 'Seleccione un cargo ...',
                    'property' => 'cargo.nombre',
                    'query_builder' => function (EntityRepository $repository) use ($organizacion) {

                        $qb = $repository->qbAllOrdenado();

                        if ($organizacion instanceof OrganizacionInterna) {

                            $qb->where('pe.organizacion = :organizacion')
                                    ->setParameter('organizacion', $organizacion);
                        } elseif (is_numeric($organizacion)) {

                            $qb->where('oi.id = :organizacion')
                                    ->setParameter('organizacion', $organizacion);
                        } else {
                            // no está claro para que está
                            $qb->where('oi.email = :organizacion')
                                    ->setParameter('organizacion', null);
                        }

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
        $organizacion = ($cargo) ? $cargo->getOrganizacion() : null;
        $this->addPlantelForm($form, $organizacion);
    }

    public function preBind(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $organizacion = array_key_exists('organizacion', $data) ? $data['organizacion'] : null;
        $this->addPlantelForm($form, $organizacion);
    }

}
