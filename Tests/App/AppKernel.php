<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Misteio\CloudinaryBundle\MisteioCloudinaryBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
        );
    }

   public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // We don't need that Environment stuff, just one config
        $loader->load(__DIR__.'/config.yml');
    }
}
