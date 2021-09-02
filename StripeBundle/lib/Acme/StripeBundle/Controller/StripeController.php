<?php

namespace Acme\StripeBundle\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends AbstractController
{

    public $publicKey;

    private $secretKey;

    public $domain;

    public $currency;

    public $successUrl;

    public $cancelUrl;

    public function __construct($key)
    {
        $this->publicKey = $key['publicKey'];
        $this->secretKey = $key['secretKey'];
        $this->domain = $key['domain'];
        $this->currency = $key['currency'];
        $this->successUrl = $key['success_url'];
        $this->cancelUrl = $key['cancel_url'];
        
    }

    /**
     * @Route("/stripe/create-session",name="stripe_create_session",)
     */

    public function createSession(Request $request): Response
    {

        $line_items = $this->addCart($request);
        Stripe::setApiKey($this->secretKey);

        try{
        $session_data = [
            'cancel_url' => $this->domain . $this->cancelUrl,
            'success_url' => $this->domain . $this->successUrl,
            'mode' => ($request->request->get('mode') ? $request->request->get('mode') : 'payment'),
            "line_items" => $line_items,
            'payment_method_types' => [
                'card',
            ],
        ];

        $checkout_session = Session::create($session_data);
    } catch(\Exception $e) {
        dd($e);
    }
        return $this->redirect($checkout_session->url);

    }

    public function addCart(Request $request) : array
    {
        $line_items = [];
        if($cart = $request->request->get("cart")){
            foreach ($cart as $val){
                $line_items[] = [
                    "price_data" => [
                        "currency" => $this->currency,
                        "unit_amount" => $val["unit_amount"],
                        "product_data" => [
                            "name" => $val["product_name"],
                            "images" => [$val["product_picture"]]
                        ], 
                    ],
                    "quantity" => $val["quantity"]
                ];
            }

        }

        return $line_items;

    }
}
