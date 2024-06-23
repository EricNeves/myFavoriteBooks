import { Component, Input, OnInit } from '@angular/core';

import { CardModule } from 'primeng/card';
import { ConfirmationService, MessageService } from 'primeng/api';
import { RatingModule } from 'primeng/rating';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { ConfirmDialogModule } from 'primeng/confirmdialog';

import { FormsModule } from '@angular/forms';
import { BookService } from '@app/services/book.service';
import { Book } from '@app/models/book.model';

import { EditBookFormComponent } from '@components/edit-book-form/edit-book-form.component';
import { CreateBookFormComponent } from '@components/create-book-form/create-book-form.component';

@Component({
  selector: 'app-books-card',
  standalone: true,
  imports: [
    CardModule,
    ButtonModule,
    RatingModule,
    FormsModule,
    ToastModule,
    EditBookFormComponent,
    CreateBookFormComponent,
    ConfirmDialogModule,
  ],
  providers: [MessageService, ConfirmationService],
  templateUrl: './books-card.component.html',
  styleUrl: './books-card.component.css',
})
export class BooksCardComponent implements OnInit {
  isVisibleEditBookForm: boolean = false;
  @Input() isVisibleCreateBookForm: boolean = false;

  books: Book[] = [];
  book!: Book;

  constructor(
    private messageService: MessageService,
    private bookService: BookService,
    private confirmationService: ConfirmationService
  ) {}

  ngOnInit(): void {
    this.getAllBooks();
  }

  getAllBooks(): void {
    this.bookService.allBooks().subscribe({
      next: (response) => {
        this.books = response.data;
      },
      error: (error) => {
        this.messageService.add({
          severity: 'error',
          summary: 'Error',
          detail: 'An error occurred while fetching books',
        });
        return;
      },
    });
  }

  openDialogEditBook(book: Book): void {
    this.book = { ...book };
    this.isVisibleEditBookForm = !this.isVisibleEditBookForm;
  }

  openDialogDeleteBook(book: Book): void {
    this.book = { ...book };

    this.confirmationService.confirm({
      message: 'Do you want to delete this record?',
      header: 'Delete Confirmation',
      icon: 'pi pi-info-circle',
      acceptButtonStyleClass: 'p-button-danger p-button-text',
      rejectButtonStyleClass: 'p-button-text p-button-text',
      acceptIcon: 'none',
      rejectIcon: 'none',
      accept: () => {
        this.bookService.deleteBook(this.book.id ?? '').subscribe({
          next: (response) => {
            this.messageService.add({
              severity: 'success',
              summary: 'Success',
              detail: 'Book deleted successfully',
            });

            this.books = this.books.filter(
              (book: Book) => book.id !== this.book.id
            );
          },
          error: (error) => {
            this.messageService.add({
              severity: 'error',
              summary: 'Error',
              detail: 'An error occurred while deleting book',
            });
          },
        });
      },
    });
  }

  updatedBook(event: Book): void {
    this.books = this.books.map((book: Book) =>
      book.id === event.id ? { ...book, ...event } : book
    );
  }

  updatedAllBooks(event: Book): void {
    this.books = [...this.books, event];
  }
}
