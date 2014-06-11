<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
//            new Symfony\Bundle\MonologBundle\MonologBundle(),
//            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
//            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
            new Fd\ActoPublicoBundle\ActoPublicoBundle(),
            new Fd\BackendBundle\BackendBundle(),
            new Fd\EdificioBundle\EdificioBundle(),
            new Fd\EstablecimientoBundle\EstablecimientoBundle(),
            new Fd\TablaBundle\TablaBundle(),
            new Fd\UsuarioBundle\UsuarioBundle(),
            new Fd\OfertaEducativaBundle\OfertaEducativaBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Ideup\SimplePaginatorBundle\IdeupSimplePaginatorBundle(),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
//            new Lexik\Bundle\MaintenanceBundle\LexikMaintenanceBundle(),
            new Lexik\Bundle\FormFilterBundle\LexikFormFilterBundle(),
            // Add your dependencies
//            new Sonata\CacheBundle\SonataCacheBundle(),
//            new Sonata\BlockBundle\SonataBlockBundle(),
//            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new JordiLlonch\Bundle\CrudGeneratorBundle\JordiLlonchCrudGeneratorBundle(),
//            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
//            new Sonata\AdminBundle\SonataAdminBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
