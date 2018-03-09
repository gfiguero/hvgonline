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
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new HVG\UserBundle\HVGUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
//            new Unisystem\UserBundle\UnisystemUserBundle(),
//            new Unisystem\AdminBundle\UnisystemAdminBundle(),
//            new Unisystem\FrontpageBundle\UnisystemFrontpageBundle(),
//            new Unisystem\UploadBundle\UnisystemUploadBundle(),
            new HVG\SystemBundle\HVGSystemBundle(),
            new HVG\AdminBundle\HVGAdminBundle(),
            new HVG\ResourcePlannerBundle\HVGResourcePlannerBundle(),
            new HVG\CustomerBundle\HVGCustomerBundle(),
            new HVG\AgentBundle\HVGAgentBundle(),
            new HVG\ContabilityBundle\HVGContabilityBundle(),
            new HVG\PublicBundle\HVGPublicBundle(),
            new HVG\AccessControlBundle\HVGAccessControlBundle(),
            new HVG\ExchangeBundle\HVGExchangeBundle(),
            new HVG\ConfigurationBundle\HVGConfigurationBundle(),
            new HVG\ProcessBundle\HVGProcessBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
