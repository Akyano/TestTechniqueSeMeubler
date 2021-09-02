<?php

/**
 * @author Badis Benkhelfallah <badis.benkhelfallah@epitech.eu>
 */

namespace Acme\StripeBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StripeBundle extends Bundle
{
    public function build(ContainerBuilder $container){
        parent::build($container);
    }
}
