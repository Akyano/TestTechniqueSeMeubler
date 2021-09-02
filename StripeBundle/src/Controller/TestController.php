<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index(): Response
    {
        echo $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
        die;
    }

    /**
     * @Route("/success", name="success")
     */
    public function success(Request $request): Response
    {
        echo("Payement accepté");
        die;
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/cancel", name="cancel")
     */
    public function cancel(Request $request): Response
    {
        echo("Payement annulé");
        die;
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
