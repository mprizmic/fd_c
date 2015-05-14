<?php
namespace Fd\OfertaEducativaBundle\Form\Extension;
 
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\CallbackValidator;
use Symfony\Component\Form\FormValidatorInterface;
 
class HelpTypeExtension extends AbstractTypeExtension
{
    /**
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['help'] = isset($options['help']) ? $options['help'] : "";
    }
 
    /**
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('help'));
    }
 
    /**
     */
    public function getExtendedType()
    {
        return 'form';
    }
}