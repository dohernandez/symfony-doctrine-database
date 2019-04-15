<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products_index")
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Product::class);

        /** @var Product $products */
        $products = $repo->findBy(['isDeleted' => false]);

        return $this->render('products/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/products/{id}", name="products_delete")
     * @param EntityManagerInterface $em
     * @param Product $product
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(EntityManagerInterface $em, Product $product)
    {
        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $product->setIsDeleted(true);

        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('products_index');
    }
}
