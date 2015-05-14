<?php
namespace Fd\BackendBundle\Tests\Form;

use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;
use Fd\BackendBundle\Form\EstablecimientoType;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

use Acme\TestBundle\Model\TestObject;

class EstablecimientoTypeTest extends TypeTestCase
{
    public function testBindValidData()
    {
        $formData = array(
            'apodo' => 'ENS 2',
        );

        $type = new EstablecimientoType();
        $form = $this->factory->create($type);

        $object = new Establecimiento();
        $object->fromArray($formData);

        $form->bind($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
