<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EdificioBundle\Repository\EdificioRepository;

class UnDomicilioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('calle', 'text', array('trim' => true, 'label' => ' ',))
                ->add('altura', 'text', array('trim' => true, 'label' => ' ',))
                ->add('c_postal', 'text', array('trim' => true, 'label' => ' ','required' => false,))
        ;
    }

    public function getName() {
        return 'fd_edificiobundle_undomiciliotype';
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Fd\EdificioBundle\Entity\Domicilio',
        );
    }

}
