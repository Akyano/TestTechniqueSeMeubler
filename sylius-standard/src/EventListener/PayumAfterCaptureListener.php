<?php

namespace App\EventListener;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\OrderRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PayumAfterCaptureListener
{
    private $orderRepository;
    private $eventDispatcher;

    public function __construct(OrderRepository $orderRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->orderRepository = $orderRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->attributes->get('_controller') === 'Payum\Bundle\PayumBundle\Controller\CaptureController::doAction')
        {

            if ($request->getSession()->getFlashBag()->has('info'))
            {
                $message = $request->getSession()->getFlashBag()->get('info')[0];
                if ($message === 'sylius.payment.completed')
                {
                    $order = $this->orderRepository->find($request->getSession()->get('sylius_order_id'));
                    if ($order)
                    {
                        $payment = $order->getPayments()->first();
                        if ($payment)
                        {
                            $event = new ResourceControllerEvent($payment);
                            $this->eventDispatcher->dispatch('sylius.payment.pre_complete', $event);
                        }
                    }

                    $request->getSession()->getBag('flashes')->add('info', $message);
                }
            }
        }
    }
}
