<?php declare(strict_types=1);

use App\Controller\BookController;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BookTest extends KernelTestCase
{
    //test Creating a Book object
    public function testBuildBookObject(): void
    {
        //init object
        $book = new Book();
        // add base values
        $book->setName('Book Test');
        $book->setMaxPages(300);
        $book->setPagesRead(250);
    
        $this->assertInstanceOf(Book::class, $book); //Must retrun a Book object to succeed
    }


    public function testCreate()
    {
        self::bootKernel();

        $container = self::$container;
        $book = new Book();
        $book->setName('Book Test');
        $book->setMaxPages(300);
        $book->setPagesRead(250);
       
        $bookController = $container->get(BookController::class);
        $this->assertEquals(true,$bookController->createBook($book));
    }

    // public function testList()
    // {
    //     self::bootKernel();
    //     $container = self::$container;
    //     $bookController = $container->get(BookController::class);
    //     $this->assertContainsOnlyInstancesOf('Book',$bookController->getAll());
    // }

  
}
  

