<?php

use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\FetchBook\FetchBookDTO;
use App\UseCases\Book\FetchBook\FetchBookUseCase;
use App\Utils\Implementations\ImageUtils;
use PHPUnit\Framework\TestCase;

class FetchBookUseCaseTest extends TestCase
{
    private $imageUtils;
    private $bookRepository;
    private $fetchBookDTO;

    public function setUp(): void
    {
        $this->imageUtils     = $this->createMock(ImageUtils::class);
        $this->bookRepository = $this->createMock(BookRepository::class);
        $this->fetchBookDTO   = $this->createMock(FetchBookDTO::class);

        $this->imageUtils->method('convertBinaryToBase64')->willReturn('data:image/png;base64,my_image_base64');
    }

    /**
     * @test
     */
    public function shouldFetchBook()
    {
        $this->bookRepository->method('findByID')->willReturn([
            'id'      => '1',
            'title'   => 'My Book',
            'rating'  => 5,
            'author'  => 'John Doe',
            'image'   => 'data:image/png;base64,my_image_base64',
            'user_id' => '1',
        ]);

        $fetchBookUseCase = new FetchBookUseCase($this->imageUtils, $this->bookRepository);

        $book = $fetchBookUseCase->execute(1, 1);

        $this->assertIsArray($book);
        $this->assertArrayHasKey('id', $book);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenBookNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Sorry, book not found.');

        $this->bookRepository->method('findByID')->willReturn(false);

        $fetchBookUseCase = new FetchBookUseCase($this->imageUtils, $this->bookRepository);

        $fetchBookUseCase->execute(1, 1);
    }
}
