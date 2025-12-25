<?php

namespace App\Controller;

use App\Form\ProductOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ProductOrderType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $this->addFlash('success', sprintf(
                'Added %d item(s) in %s color to cart!', 
                $data['quantity'], 
                $data['color']
            ));
            
            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
