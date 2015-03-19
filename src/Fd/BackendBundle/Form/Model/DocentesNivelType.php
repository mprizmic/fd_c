<?php

namespace Fd\BackendBundle\Form\Model;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Model\DocentesNivelClass;

class DocentesNivelType extends AbstractType {

    /**
     * Se tienen que crear los campos correspondientes a los niveles existentes en el establecimiento
     * 
     * @param FormBuilderInterface $builder
     * @param array $options 
     */
    private $localizaciones;
    private $niveles;

    public function __construct(EstablecimientoEdificio $establecimiento_edificio, $niveles) {
        

        $this->localizaciones = $establecimiento_edificio->getLocalizacion();
        $this->niveles = $niveles;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        foreach ($this->localizaciones as $localizacion) {

            //tomo el nombre del nivel que es el mismo que el subfijo del campo de unidad_educativa, pero todo en minuscula
            $nombre_nivel = strtolower(array_search($localizacion->getUnidadEducativa()->getNivel()->getAbreviatura(), $this->niveles));
    
            $builder
                    ->add('cantidad_' . $nombre_nivel, 'integer', array(
                        'required' => false,
                        'label'=>'Cantidad de '.$nombre_nivel,
                        'attr'=>array(
                            'size'=>3,
                        ),
                    ));
        }
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Model\DocentesNivelClass',
        ));
    }

    public function getName() {
        return 'docentesnivel_type';
    }

}
