<?php

namespace Misteio\CloudinaryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('misteio_cloudinary');

        $rootNode
            ->children()
                ->scalarNode('cloud_name')
                ->isRequired()
                ->cannotBeEmpty()
                ->end()
                    ->scalarNode('api_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                    ->scalarNode('secret_key')
                    ->isRequired()
                    ->cannotBeEmpty()
            ->end()
        ;

        return $treeBuilder;
    }
}
