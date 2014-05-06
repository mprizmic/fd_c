<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

class EstablecimientoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cue', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_05',
                    )
                ))
                ->add('nombre', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_5',
                    ),
                ))
                ->add('apodo', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_1',
                    ),
                    'help' => 'Es el nombre con que se lo conoce o con que se lo nombra diariamente',
                ))
                ->add('tipo_establecimiento')
                ->add('te', 'text', array(
                    'required' => false,
                ))
                ->add('orden', 'number', array(
                    'help' => 'Es un número de orden en que se quiere que éste establecimiento aparezca en los listados',
                    'attr' => array(
                        'class' => 'input_talle_05',
                    )
                ))
                ->add('numero', 'number', array(
                    'required' => false,
                    'help' => 'Es un número del establecimiento',
                    'attr' => array(
                        'class' => 'input_talle_05',
                        )))
                ->add('email')
                ->add('url', 'text', array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'input_talle_5',
                    )
                ))
                ->add('cargo_autoridad')
                ->add('nombre_autoridad')
//                ->add('fecha_creacion', 'date', array(
//                    'label' => 'Fecha de creación',
//                ))
                ->add('fecha_elecciones', 'date', array(
                    'label' => 'Fecha de las próximas elecciones',
                ))
                ->add('fin_mandato', 'date', array(
                    'label' => 'Fin del mandato',
                ))
//                ->add('comparte_edificio', 'si_no_sd', array(
//                    'label' => 'Comparte edificio',
//                    'required' => false,
//                ))
                ->add('fecha_creacion', 'date', array(
                    'label' => 'Fecha de creación',
                ))
                ->add('tiene_cooperadora', 'si_no_sd', array(
                    'required' => false,
                    'label'=>'Tiene cooperadora',
                ))
                ->add('distrito_escolar')
                ->add('codigo_previo_transferencia')
                ->add('campo_deportes', 'text', array(
                    'label' => 'Campo de deportes',
                    'required' => false,
                    'attr' => array(
                        'class' => 'input_talle_4',
                    ),
                    'help' => 'Domicilio del campo de deportes',
                ))
                ->add('fecha_presentacion_roi', 'date', array(
                    'help' => 'Fecha en que se presentaron los papeles para el trámite de aprobación del ROI',
                    'label' => 'Fecha de presentación del ROI',
                    'required' => false,
                ))
                ->add('fecha_aprobacion_roi', 'date', array(
                    'help' => 'Fecha en que se aprobó el trámite de aprobación del ROI',
                    'label' => 'Fecha de aprobación del ROI',
                    'required' => false,
                ))
                ->add('fecha_presentacion_ram', 'date', array(
                    'help' => 'Fecha en que se presentaron los papeles para el trámite de aprobación del RAM',
                    'label' => 'Fecha de presentación del RAM',
                    'required' => false,
                ))
                ->add('fecha_aprobacion_ram', 'date', array(
                    'help' => 'Fecha en que se aprobó el trámite de aprobación del RAM',
                    'label' => 'Fecha de aprobación del RAM',
                    'required' => false,
                ))
                ->add('fecha_presentacion_rp', 'date', array(
                    'help' => 'Fecha en que se presentaron los papeles para el trámite de aprobación del R. PRÁCTICAS',
                    'label' => 'Fecha de presentación del R.PRÁCTICAS',
                    'required' => false,
                ))
                ->add('fecha_aprobacion_rp', 'date', array(
                    'help' => 'Fecha en que se aprobó el trámite de aprobación del R.PRÁCTICAS',
                    'label' => 'Fecha de aprobación del R.PRÁCTICAS',
                    'empty_value' => '',
                    'required' => false,
                ))
                ->add('anio_inicio_nes', 'integer', array(
                    'required' => false,
                    'help' => 'Año de inicio de la Nueva Escuela Secundaria',
                    'label' => 'Año de la NES',
                    'attr' => array(
                        'class' => 'input_talle_05'),
                ))
                ->add('descripcion', 'text', array(
                    'label' => 'Descripción',
                    'required' => false,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\Establecimiento'
        ));
    }

    public function getName() {
        return 'fd_establecimientobundle_establecimientotype';
    }

}
