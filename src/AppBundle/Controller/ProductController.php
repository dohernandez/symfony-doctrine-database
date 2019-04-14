<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products_index")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);

        /** @var Product $products */
        $products = $repo->findAll();

        return $this->render('products/index.html.twig', [
            'products' => $products
        ]);
    }
    /**
     * @Route("/products/{id}", name="products_delete")
     */
    public function deleteAction(Product $product)
    {
        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $product->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('products_index');
    }
}
