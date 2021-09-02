<?php

declare(strict_types=1);

namespace Acme\SyliusStripeGatewayPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SyliusStripeGatewayConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('public_key', TextType::class);
        $builder->add('secret_key', TextType::class);
    }
}