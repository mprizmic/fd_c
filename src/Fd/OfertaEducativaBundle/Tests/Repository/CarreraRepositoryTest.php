<?php

namespace Fd\OfertaEducativaBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class CarreraRepositoryTest extends WebTestCase {

    private $em;
    private $repo;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager()
        ;
        $this->repo = $this->em
                ->getRepository('OfertaEducativaBundle:Carrera')
        ;
    }

    public function testFindResumido() {
        $carreras = $this->repo
                ->qyResumido()
                ->getResult();
        $this->assertCount(46, $carreras);
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }


}