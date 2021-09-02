<?php

namespace Acme\StripeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class StripeExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter("acme_stripe.public_key", $config['public_key']);
        $container->setParameter('acme_stripe.secret_key', $config['secret_key']);
        $container->setParameter('acme_stripe.domain', $config['domain']);
        $container->setParameter('acme_stripe.currency', $config['currency']);
        $container->setParameter('acme_stripe.success_url', $config['success_url']);
        $container->setParameter('acme_stripe.cancel_url', $config['cancel_url']);
    }
}
