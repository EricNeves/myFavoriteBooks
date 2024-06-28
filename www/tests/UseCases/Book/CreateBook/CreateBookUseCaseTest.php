<?php

use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\CreateBook\CreateBookDTO;
use App\UseCases\Book\CreateBook\CreateBookUseCase;
use App\Utils\Implementations\ImageUtils;
use PHPUnit\Framework\TestCase;

class CreateBookUseCaseTest extends TestCase
{
    private $imageUtils;
    private $bookRepository;
    private $createBookDTO;

    public function setUp(): void
    {
        $this->imageUtils     = $this->createMock(ImageUtils::class);
        $this->bookRepository = $this->createMock(BookRepository::class);
        $this->createBookDTO  = $this->createMock(CreateBookDTO::class);

        $this->createBookDTO->method('toArray')->willReturn([
            'title'  => 'My Book',
            'rating' => 5,
            'author' => 'John Doe',
            'image'  => 'data:image/png;base64,my_image_base64',
        ]);

        $this->imageUtils->method('removeImageDataPrefix')->willReturn('my_image_base64');
        $this->imageUtils->method('convertBase64ToBinary')->willReturn('my_image_binary');
        $this->bookRepository->method('lastInsertId')->willReturn(1);
    }

    /**
     * @test
     */
    public function shouldCreateBook()
    {
        $this->imageUtils->method('validate')->willReturn(true);

        $this->bookRepository->method('save')->willReturn(true);

        $createBookUseCase = new CreateBookUseCase($this->imageUtils, $this->bookRepository);

        $createBook = $createBookUseCase->execute($this->createBookDTO);

        $this->assertIsArray($createBook);
        $this->assertArrayHasKey('id', $createBook);
    }

    /**
     * @test
     */
    public function shouldNotCreateBookWhenImageIsInvalid()
    {
        $this->imageUtils->method('validate')->willReturn(false);

        $createBookUseCase = new CreateBookUseCase($this->imageUtils, $this->bookRepository);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid image type. Please, use only PNG, JPEG or JPG.");

        $createBookUseCase->execute($this->createBookDTO);
    }

    /**
     * @test
     */
    public function shouldNotCreateBookWhenRepositoryFails()
    {
        $this->imageUtils->method('validate')->willReturn(true);

        $this->bookRepository->method('save')->willReturn(false);

        $createBookUseCase = new CreateBookUseCase($this->imageUtils, $this->bookRepository);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Sorry, we couldn't create the book. Please try again.");

        $createBookUseCase->execute($this->createBookDTO);
    }
}
