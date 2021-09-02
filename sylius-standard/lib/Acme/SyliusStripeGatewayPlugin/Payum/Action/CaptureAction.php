<?php

declare(strict_types=1);

namespace Acme\SyliusStripeGatewayPlugin\Payum\Action;

use Acme\SyliusStripeGatewayPlugin\Payum\SyliusStripeApi;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Payum\Core\Action\ActionInterface;
use Payum\Core\ApiAwareInterface;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Exception\UnsupportedApiException;
use Sylius\Component\Core\Model\PaymentInterface as SyliusPaymentInterface;
use Payum\Core\Request\Capture;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Payum\Core\Bridge\Spl\ArrayObject;


final class CaptureAction implements ActionInterface, ApiAwareInterface
{
    /** @var Client */
    private $client;
    /** @var SyliusStripeApi */
    private $api;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute($request): void
    {
        RequestNotSupportedException::assertSupports($this, $request);

        /** @var SyliusPaymentInterface $payment */
        $payment = $request->getModel();

        try {
            Stripe::setApiKey($this->api->getSecretKey());

            $paymentIntent = PaymentIntent::create([
                "amount" => $payment->getAmount(),
                'currency' => $payment->getCurrencyCode(),
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
              ];
        } catch (RequestException $exception) {
            http_response_code(500);
        }
    }

    public function supports($request): bool
    {
        return
            $request instanceof Capture &&
            $request->getModel() instanceof SyliusPaymentInterface
        ;
    }

    public function setApi($api): void
    {
        if (!$api instanceof SyliusStripeApi) {
            throw new UnsupportedApiException('Not supported. Expected an instance of ' . SyliusStripeApi::class);
        }

        $this->api = $api;
    }
}