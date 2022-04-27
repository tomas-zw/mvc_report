<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    ): Response {
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
    ): Response {
        $book = $productRepository->find($id);

        $data = [
            'book' => $book,
            'title' => 'book by id'
        ];
        return $this->render('product/oneBook.html.twig', $data);
    }

    /**
    * @Route("/product/create",
    * name="create_product_post",
    *   methods={"POST"})
     */
    public function createProductPost(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        $product = new Book();
        $product->setTitle($request->request->get('title'));
        $product->setIsbn($request->request->get('isbn'));
        $product->setAuthor($request->request->get('author'));
        $product->setImage($request->request->get('image'));

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('product_by_id', ['id' => $product->getId()]);
    }

    /**
    * @Route("/product/create",
    * name="create_product"
    * )
     */
    public function createProduct(
    ): Response
    {
        $data = [
            'title' => 'Skapa ny bok'
        ];

        return $this->render('product/createBook.html.twig', $data);
    }
}
