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
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\TablaBundle\Entity\Dependencia;

class AddOrganizacionFieldPlantelSubscriber implements EventSubscriberInterface {

    private $factory;
    private $edit_disabled;

    public function __construct(FormFactoryInterface $factory) {
        $this->factory = $factory;
        $this->edit_disabled = false;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND => 'preBind'
        );
    }

    private function addOrganizacionForm($form, $organizacion, $establecimiento) {
        
        $options = array(
            'class' => 'EstablecimientoBundle:OrganizacionInterna',
            'empty_value' => 'Dependencia...',
            'label' => 'Dependencia',
            'disabled' => $this->edit_disabled,
            'property' => 'dependencia.nombre',
            'query_builder' => function (EntityRepository $repository) use ($establecimiento) {

                $qb = $repository->qbAllOrdenado();

                if ($establecimiento instanceof EstablecimientoEdificio) {

                    $qb->where('oi.establecimiento = :establecimiento')
                            ->setParameter('establecimiento', $establecimiento);
                } elseif (is_numeric($establecimiento)) {

                    $qb->where('ee.id = :establecimiento')
                            ->setParameter('establecimiento', $establecimiento);
                } else {
                    // no está claro para que está
                    $qb->where('oi.email = :establecimiento')
                            ->setParameter('establecimiento', null);
                }

                return $qb;
            },
        );

        $form->add($this->factory->createNamed('organizacion', 'entity', $organizacion, $options));
    }

    public function preSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        if ($data->getId()) {
            $this->edit_disabled = true;
        }

        $organizacion = $data->getOrganizacion();
        $establecimiento = ($organizacion) ? $organizacion->getEstablecimiento() : null;
        $this->addOrganizacionForm($form, $organizacion, $establecimiento);
    }

    public function preBind(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $organizacion = array_key_exists('organizacion', $data) ? $data['organizacion'] : null;
        $establecimiento = array_key_exists('establecimiento', $data) ? $data['establecimiento'] : null;
        $this->addOrganizacionForm($form, $organizacion, $establecimiento);
    }

}
