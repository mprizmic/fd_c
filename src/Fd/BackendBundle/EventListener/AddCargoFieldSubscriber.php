<?php
 
namespace Fd\BackendBundle\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\TablaBundle\Entity\PlantelEstablecimiento;
 

/**
 * Agrega el campo cargo al tipo que es un combo para seleccionar el cargo que en realidad es
 * un registro de plantel_establecimiento
 */
class AddCargoFieldSubscriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }
 
    private function addCargoForm($form, $establecimiento_edificio)
    {
        $form->add($this->factory->createNamed('cargo','entity', null, array(
            'class'         => 'EstablecimientoBundle:PlantelEstablecimiento',
            'empty_value'   => 'Seleccion un cago ...',
            'query_builder' => function (EntityRepository $repository) use ($establecimiento_edificio) {
                $qb = $repository->qbAllOrdenado();
                if ($establecimiento_edificio instanceof EstablecimientoEdificio) {
                    $qb->where('oi.establecimiento = :establecimiento_edificio')
                    ->setParameter('establecimiento_edifcio', $establecimiento_edificio);
                } elseif (is_numeric($establecimiento_edificio)) {
                    $qb->where('ee.id = :establecimiento_edificio')
                    ->setParameter('establecimiento_edificio', $establecimiento_edificio);
                } else {
                    $qb->where('establecimiento_edificio.nombre = :establecimiento_edificio')
                    ->setParameter('establecimiento_edificio', null);
                }
 
                return $qb;
            }
        )));
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $establecimiento_edificio = ($data->cargo) ? $data->cargo->getOrganizacion()->getEstablecimiento() : null ;
        $this->addCargoForm($form, $establecimiento_edificio);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $establecimiento_edificio = array_key_exists('establecimiento_edificio', $data) ? $data['establecimiento_edificio'] : null;
        $this->addCargoForm($form, $establecimiento_edificio);
    }
}
