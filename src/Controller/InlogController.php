<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InlogController extends AbstractController
{
    #[Route('/inlog', name: 'app_inlog')]
    public function index(): Response
    {
        return $this->render('inlog/index.html.twig', [
            'controller_name' => 'InlogController',
        ]);
    }
}
