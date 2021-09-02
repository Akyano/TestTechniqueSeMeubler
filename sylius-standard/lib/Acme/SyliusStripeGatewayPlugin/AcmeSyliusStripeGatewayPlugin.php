<?php

declare(strict_types=1);

namespace Acme\SyliusStripeGatewayPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AcmeSyliusStripeGatewayPlugin extends Bundle
{
    use SyliusPluginTrait;
}