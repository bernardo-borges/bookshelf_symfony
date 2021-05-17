<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }


    public function new(Request $request): Response
    {
        $book = new Book();
        $book->setName('Write a blog post');
        $book->setMaxPages(1);
        $book->setPagesRead(0);

        $form = $this->createFormBuilder($book)
            ->add('name', TextType::class)
            ->add('max_pages', IntegerType::class)
            ->add('pages_read',IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Book'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $bookData = $form->getData();    
                $db = $this->getDoctrine()->getManager();
                $db->persist($bookData);
                $db->flush();
                return $this->redirectToRoute('listBook');
            }

            return $this->render('book/book.html.twig', [
                'form' => $form->createView(),
            ]); 
        
        }


        public function list(): Response
        {
            $repository = $this->getDoctrine()->getRepository(Book::class);
            $books = $repository->findAll();
            return $this->render('book/list.html.twig', ['list' => $books]);
        }

        public function delete(int $id , Request $request): Response
        {
 
            $entityManager = $this->getDoctrine()->getManager();
            $book = $entityManager->getRepository(Book::class)->find($id);
            $entityManager->remove($book);
            $entityManager->flush();

            return $this->redirectToRoute('listBook');
        }


        public function edit(int $id,Request $request): Response
        {
            
            $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);


    
            $form = $this->createFormBuilder($book)
                ->add('name', TextType::class)
                ->add('max_pages', IntegerType::class)
                ->add('pages_read',IntegerType::class)
                ->add('save', SubmitType::class, ['label' => 'Edit Book'])
                ->getForm();
    
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $bookData = $form->getData();    
                    $db = $this->getDoctrine()->getManager();
                    $db->persist($bookData);
                    $db->flush();
                    return $this->redirectToRoute('listBook');
                }
    
                return $this->render('book/book.html.twig', [
                    'form' => $form->createView(),
                ]); 
        
            
        }


}
