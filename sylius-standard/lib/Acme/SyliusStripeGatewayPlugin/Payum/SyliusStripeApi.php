<?php

declare(strict_types=1);

namespace Acme\SyliusStripeGatewayPlugin\Payum;

final class SyliusStripeApi
{
    /** @var string */
    private $publicKey;

    /** @var string */
    private $secretKey;

    public function __construct(string $publicKey,string $secretKey)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}