<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage() {
        $categories = [
            'Vlees',
            'Vegetarisch',
            'Vis'
        ];
        return $this->render('categories.html.twig', [
            'categories' => $categories
        ]);
    }
    /**
     * @Route("/{cat}")
     */
    public function category($cat){

        $pizza = [
            'Vlees',
            'Vegetarisch',
            'Vis'
        ];
        return $this->render('pizza/category',[
            'cat'=> $cat,
            'pizzas' => $pizza
        ]);
    }

}
