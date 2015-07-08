<?php

namespace Fd\BackendBundle\Form\Model;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Model\DocentesNivelClass;

class MatriculaNivelType extends AbstractType {

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
                    ->add('matricula_' . $nombre_nivel, 'integer', array(
                        'required' => false,
                        'label' => 'Matrícula de ' . $nombre_nivel,
                        'attr' => array(
                            'class' => 'input_talle_05',
                        ),
            ));
        }
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Model\MatriculaNivelClass',
        ));
    }

    public function getName() {
        return 'matriculanivel_type';
    }

}
