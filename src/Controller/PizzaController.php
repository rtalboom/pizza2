<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Form\OrderType;
use App\Repository\CategoryRepository;
use App\Repository\OrderRepository;
use App\Repository\PizzaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Entity\ManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PizzaController extends AbstractController
{
    /**
     * @Route ("/", name="app_home")
     */
    public function home(CategoryRepository $em)
    {
        #Haalt de repository van de Entiteit class op#
        $cat = $em->findAll();
        return $this->render('pizza/home.html.twig', ['category' => $cat,]);
    }


    /**
     * @Route ("/pizza/{pizza}", name="app_pizza", methods={"GET","HEAD"})
     */
    public function pizza(int $pizza, PizzaRepository $em)
    {
        #Haalt de repository van de Entiteit class op#
        $pizza = $em->findBy(array('category' => $pizza));
        return $this->render('pizza/pizza.html.twig', ['pizza' => $pizza,]);
    }

    /** * @Route("/order/{id}", name="app_order"); */
    public function order($id, Request $request, PizzaRepository $pizzaRepository, ManagerRegistry $managerRegistry, Pizza $pizzas)
    {
        $pizzaName = $pizzas->getName();
        $pizza = $pizzaRepository->find($id);

        $entityManager = $managerRegistry->getManager();
        $order = new Order();
        $order->setPizza($pizza);
        $order->setStatus("in progress");
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'Uw pizza wordt bereid.');

            return $this->redirectToRoute('app_home');

        }
        return $this->renderForm('order/index.html.twig', [
            'form' => $form,
            'pizza' => $pizzaName,
        ]);
    }
    /**
     * @Route("/orders", name="pizza_showorders")
     */
    public function showOrders(OrderRepository $orderRepository, PizzaRepository $pizza)
    {
        $orders = $orderRepository ->findAll();
        return $this->render('pizza/allOrders.html.twig',
            ['orders' => $orders]);
    }
}



