<?php

declare(strict_types=1);

namespace Acme\SyliusStripeGatewayPlugin\Payum;

use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;
use Acme\SyliusStripeGatewayPlugin\Payum\Action\StatusAction;
use Acme\SyliusStripeGatewayPlugin\Payum\Action\CaptureAction;

final class SyliusStripePaymentGatewayFactory extends GatewayFactory
{
    protected function populateConfig(ArrayObject $config): void
    {
        $config->defaults([
            'payum.factory_name' => 'sylius_stripe_payment',
            'payum.factory_title' => 'Sylius Stripe Payment',
            'payum.action.status' => new StatusAction(),
        ]);

        $config['payum.api'] = function (ArrayObject $config) {
            return new SyliusStripeApi($config['public_key'],$config['secret_key']);
        };
    }
}