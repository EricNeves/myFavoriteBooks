<?php

use App\Repositories\IBookRepository;
use App\UseCases\Book\RemoveBook\RemoveBookDTO;
use App\UseCases\Book\RemoveBook\RemoveBookUseCase;
use PHPUnit\Framework\TestCase;

class RemoveBookUseCaseTest extends TestCase
{
    private $bookRepository;
    private $removeBookDTO;

    public function setUp(): void
    {
        $this->bookRepository = $this->createMock(IBookRepository::class);
        $this->removeBookDTO  = $this->createMock(RemoveBookDTO::class);

        $this->removeBookDTO->method('toArray')->willReturn([
            'id'      => '1',
            'title'   => 'My Book',
            'rating'  => 5,
            'author'  => 'John Doe',
            'image'   => 'data:image/png;base64,my_image_base64',
            'user_id' => '1',
        ]);
    }

    /**
     * @test
     */
    public function shouldRemoveBook()
    {
        $this->bookRepository->method('delete')->willReturn(true);

        $removeBookUseCase = new RemoveBookUseCase($this->bookRepository);

        $book = $removeBookUseCase->execute($this->removeBookDTO);

        $this->assertIsArray($book);
        $this->assertArrayHasKey('user_id', $book);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenBookNotRemoved()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Sorry, we couldn't delete the book. Please, try again later.");

        $this->bookRepository->method('delete')->willReturn(false);

        $removeBookUseCase = new RemoveBookUseCase($this->bookRepository);

        $removeBookUseCase->execute($this->removeBookDTO);
    }
}
