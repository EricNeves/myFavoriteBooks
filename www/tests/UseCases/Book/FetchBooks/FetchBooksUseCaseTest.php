<?php

use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\FetchBooks\FetchBooksUseCase;
use App\Utils\Implementations\ImageUtils;
use PHPUnit\Framework\TestCase;

class FetchBooksUseCaseTest extends TestCase
{
    private $imageUtils;
    private $bookRepository;

    public function setUp(): void
    {
        $this->imageUtils     = $this->createMock(ImageUtils::class);
        $this->bookRepository = $this->createMock(BookRepository::class);

        $this->imageUtils->method('convertBinaryToBase64')->willReturn('data:image/png;base64,my_image_base64');
    }

    /**
     * @test
     */
    public function shouldReturnBooks()
    {
        $this->bookRepository->method('all')->willReturn([
            [
                'id'      => '1',
                'title'   => 'My Book',
                'rating'  => 5,
                'author'  => 'John Doe',
                'image'   => 'data:image/png;base64,my_image_base64',
                'user_id' => '1',
            ],
            [
                'id'      => '2',
                'title'   => 'My Book 2',
                'rating'  => 4,
                'author'  => 'Jane Doe',
                'image'   => 'data:image/png;base64,my_image_base64',
                'user_id' => '1',
            ],
        ]);

        $fetchBooksUseCase = new FetchBooksUseCase($this->imageUtils, $this->bookRepository);

        $books = $fetchBooksUseCase->execute(1);

        $this->assertIsArray($books);
    }

    /**
     * @test
     */
    public function shouldReturnEmptyArrayWhenNoBooksFound()
    {
        $this->bookRepository->method('all')->willReturn([]);

        $fetchBooksUseCase = new FetchBooksUseCase($this->imageUtils, $this->bookRepository);

        $books = $fetchBooksUseCase->execute(1);

        $this->assertIsArray($books);
        $this->assertEmpty($books);
    }
}
