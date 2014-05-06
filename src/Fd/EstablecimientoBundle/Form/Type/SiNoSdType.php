<?php
namespace Fd\EstablecimientoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SiNoSdType extends AbstractType
{
    private $si_no_sd;
    
    public function __construct( array $si_no_sd ){
        $this->si_no_sd = $si_no_sd;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->si_no_sd,
            'empty_value' => 'Seleccione ...',
            'empty_data' => null,
            )
        );
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'si_no_sd';
    }
}