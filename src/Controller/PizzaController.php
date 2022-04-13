<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Pizza;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PizzaController extends AbstractController
{
    /**
     * @Route ("/", name="app_home")
     */
    public function home(EntityManagerInterface $em){
        #Haalt de repository van de Entiteit class op#
        $repository = $em->getRepository(Category::class);
        /** @var Category $cat */
        $cat = $repository->findAll();
        return $this->render('pizza/home.html.twig', [ 'category' => $cat, ]);
    }

/**
* @Route ("/contact", name="pizza_contact")
*/
    public function contact(): Response
    {
        return new Response('Future page to show categories');
        return $this->render("pizza/contact.html.twig");
    }

    /**
     * @Route ("/pizza/{pizza}", name="app_pizza", methods={"GET","HEAD"})
     */
    public function pizza(int $pizza, EntityManagerInterface $en){
        #Haalt de repository van de Entiteit class op#
        $repository = $en->getRepository(Pizza::class);
        /** @var Pizza $pizza */
        $pizza = $repository->findBy(array('category'=>$pizza));
        return $this->render('pizza/pizza.html.twig', [ 'pizza' => $pizza, ]);
    }
}

