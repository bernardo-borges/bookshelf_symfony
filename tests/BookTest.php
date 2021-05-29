<?php declare(strict_types=1);

use App\Controller\BookController;
use App\Entity\Book;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Persistence\ObjectManager;

final class BookTest extends KernelTestCase
{
    public function testBuildBookObject(): void
    {
        $book = new Book();
        $book->setName('Book Test');
        $book->setMaxPages(3331);
        $book->setPagesRead(344123);
    
        $this->assertInstanceOf(Book::class, $book);
    }


    public function testCreate()
    {
        self::bootKernel();

        $container = self::$container;
        $book = new Book();
        $book->setName('Book Test');
        $book->setMaxPages(3331);
        $book->setPagesRead(344123);
       
        $bookController = $container->get(BookController::class);
        $this->assertEquals(true,$bookController->createBook($book));
    }

    public function testList()
    {
        self::bootKernel();
        $container = self::$container;
        $bookController = $container->get(BookController::class);
        $this->assertContainsOnlyInstancesOf('Book',$bookController->getAll());
    }

  
}
  

