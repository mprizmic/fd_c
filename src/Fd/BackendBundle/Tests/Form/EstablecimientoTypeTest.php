<?php

namespace Fd\BackendBundle\Tests\Form;

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;
use Fd\BackendBundle\Form\EstablecimientoType;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\OfertaEducativaBundle\Form\Extension\HelpTypeExtension;

class EstablecimientoTypeTest extends TypeTestCase {

    protected function setUp() {
        parent::setUp();

        $this->factory = Forms::createFormFactoryBuilder()
                ->addTypeExtension(new HelpTypeExtension()
                )
                ->addTypeGuesser(
                        $this->getMockBuilder(
                                'Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser'
                        )
                        ->disableOriginalConstructor()
                        ->getMock()
                )
                ->getFormFactory();

        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->builder = new FormBuilder(null, null, $this->dispatcher, $this->factory);
    }

    /**
     * @dataProvider getValidTestData
     */
    public function testForm($formData) {

        $this->factory->addType(new \Fd\EstablecimientoBundle\Form\Type\SiNoSdType(array(
            'si' => 'Si',
            'no' => 'No',
            'sd' => 'Sin datos',
        )));

        $type = new EstablecimientoType();
        $form = $this->factory->create($type);

        $object = new Establecimiento($formData);
////        $object->fromArray($formData);
//
        $form->bind($formData);
//
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function getValidTestData() {
        return array(
            array(
                'data' => array(
                    'apodo' => null,
                ),
            ),
        );
    }

}
