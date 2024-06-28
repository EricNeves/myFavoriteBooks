<?php

use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\EditBook\EditBookDTO;
use App\UseCases\Book\EditBook\EditBookUseCase;
use App\Utils\Implementations\ImageUtils;
use PHPUnit\Framework\TestCase;

class EditBookUseCaseTest extends TestCase
{
    private $imageUtils;
    private $bookRepository;
    private $editBookDTO;

    public function setUp(): void
    {
        $this->imageUtils     = $this->createMock(ImageUtils::class);
        $this->bookRepository = $this->createMock(BookRepository::class);
        $this->editBookDTO    = $this->createMock(EditBookDTO::class);

        $this->editBookDTO->method('toArray')->willReturn([
            'id'      => '1',
            'title'   => 'My Book',
            'rating'  => 5,
            'author'  => 'John Doe',
            'image'   => 'data:image/png;base64,my_image_base64',
            'user_id' => '1',
        ]);

        $this->imageUtils->method('removeImageDataPrefix')->willReturn('my_image_base64');
        $this->imageUtils->method('convertBase64ToBinary')->willReturn('my_image_binary');
    }

    /**
     * @test
     */
    public function shouldEditBook()
    {
        $this->imageUtils->method('validate')->willReturn(true);
        $this->bookRepository->method('update')->willReturn(true);

        $editBookUseCase = new EditBookUseCase($this->imageUtils, $this->bookRepository);

        $editBook = $editBookUseCase->execute($this->editBookDTO);

        $this->assertIsArray($editBook);
        $this->assertArrayHasKey('id', $editBook);
    }

    /**
     * @test
     */
    public function shouldNotEditBookWhenImageIsInvalid()
    {
        $this->imageUtils->method('validate')->willReturn(false);

        $editBookUseCase = new EditBookUseCase($this->imageUtils, $this->bookRepository);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid image type. Please, use only PNG, JPEG or JPG.");

        $editBookUseCase->execute($this->editBookDTO);
    }

    /**
     * @test
     */
    public function shouldNotEditBookWhenUpdateBookFails()
    {
        $this->imageUtils->method('validate')->willReturn(true);
        $this->bookRepository->method('update')->willReturn(false);

        $editBookUseCase = new EditBookUseCase($this->imageUtils, $this->bookRepository);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Sorry, we couldn't update the book. Please, try again later.");

        $editBookUseCase->execute($this->editBookDTO);
    }
}
