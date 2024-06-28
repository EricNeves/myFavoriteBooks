<?php

use App\Providers\Implementations\BookPostgresProvider;
use App\Repositories\Implementations\BookRepository;
use PHPUnit\Framework\TestCase;

class BookRepositoryTest extends TestCase
{
    private $bookPostgresProvider;

    public function setUp(): void
    {
        $this->bookPostgresProvider = $this->createMock(BookPostgresProvider::class);
    }

    /**
     * @test
     */
    public function shouldReturnLastInsertedIdTypeInt()
    {
        $this->bookPostgresProvider->method('lastInsertId')->willReturn(1);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertEquals(1, $book->lastInsertId());
        $this->assertIsInt($book->lastInsertId());
    }

    /**
     * @test
     */
    public function shouldReturnLastInsertedIdTypeString()
    {
        $this->bookPostgresProvider->method('lastInsertId')->willReturn('1');

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertEquals('1', $book->lastInsertId());
        $this->assertIsString($book->lastInsertId());
    }

    /**
     * @test
     */
    public function shouldReturnTrueWhenSaveBook()
    {
        $this->bookPostgresProvider->method('create')->willReturn(true);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertTrue($book->save([]));
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenNotSaveBook()
    {
        $this->bookPostgresProvider->method('create')->willReturn(false);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertFalse($book->save([]));
    }

    /**
     * @test
     */
    public function shouldReturnAllBooks()
    {
        $this->bookPostgresProvider->method('fetchAll')->willReturn([]);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertEquals([], $book->all(1));
    }

    /**
     * @test
     */
    public function shouldReturnBookById()
    {
        $this->bookPostgresProvider->method('findById')->willReturn([]);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertEquals([], $book->findByID(1, 1));
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenBookNotFoundById()
    {
        $this->bookPostgresProvider->method('findById')->willReturn(false);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertFalse($book->findByID(1, 1));
    }

    /**
     * @test
     */
    public function shouldReturnTrueWhenUpdateBook()
    {
        $this->bookPostgresProvider->method('update')->willReturn(true);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertTrue($book->update([], 1));
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenNotUpdateBook()
    {
        $this->bookPostgresProvider->method('update')->willReturn(false);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertFalse($book->update([], 1));
    }

    /**
     * @test
     */
    public function shouldReturnTrueWhenDeleteBook()
    {
        $this->bookPostgresProvider->method('delete')->willReturn(true);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertTrue($book->delete(1, 1));
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenNotDeleteBook()
    {
        $this->bookPostgresProvider->method('delete')->willReturn(false);

        $book = new BookRepository($this->bookPostgresProvider);

        $this->assertFalse($book->delete(1, 1));
    }
}
