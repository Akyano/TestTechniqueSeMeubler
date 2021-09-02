<?php

namespace Acme\StripeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder('acme_stripe');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('public_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('secret_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('domain')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('success_url')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('cancel_url')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('currency')
                    ->defaultValue("USD")
                ->end()
            ->end();

        return $treeBuilder;
    }
}
