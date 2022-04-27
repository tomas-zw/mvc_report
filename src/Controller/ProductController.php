<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\BookRepository;
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
    * @Route(
    *   "/product/show",
    *   name="product_show_all"
    *   )
    */
    public function showAllProduct(
        BookRepository $productRepository
    ): Response
    {
        $books = $productRepository->findAll();
        # $jsonBooks = $this->json($products);

        # return $this->json($products);
        $data = [
            'books' => $books,
            'title' => 'All Books'
        ];
        return $this->render('product/allBooks.html.twig', $data);
    }

    /**
    * @Route(
    *   "/product/show/{id}",
    *   name="product_by_id"
    *   )
    */
    public function showProductById(
        BookRepository $productRepository,
        int $id
    ): Response
    {
        $book = $productRepository->find($id);

        $data = [
            'book' => $book,
            'title' => 'book by id'
        ];
        return $this->render('product/oneBook.html.twig', $data);
    }

    /**
     * @Route("/product/create", name="create_product")
     */
    public function createProduct(
        ManagerRegistry $doctrine
    ): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Book();
        $product->setTitle('Dune');
        $product->setIsbn('9780340960196');
        $product->setAuthor('Frank Herbert');
        $product->setImage('https://www.sfbok.se/sites/default/files/styles/large/sfbok/sfbokbilder/146/146243.jpg?bust=1435828540&itok=Y73Sylij');

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
}

