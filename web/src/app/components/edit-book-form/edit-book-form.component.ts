import {
  Component,
  EventEmitter,
  Input,
  OnChanges,
  OnInit,
  Output,
  ViewChild,
} from '@angular/core';

import { JsonPipe } from '@angular/common';
import { Book } from '@app/models/book.model';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { FileUpload, FileUploadModule } from 'primeng/fileupload';
import { DialogModule } from 'primeng/dialog';
import { InputTextModule } from 'primeng/inputtext';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';
import { RatingModule } from 'primeng/rating';
import { BookService } from '@app/services/book.service';

@Component({
  selector: 'app-edit-book-form',
  standalone: true,
  imports: [
    ToastModule,
    DialogModule,
    JsonPipe,
    ReactiveFormsModule,
    FileUploadModule,
    InputTextModule,
    ButtonModule,
    RatingModule,
    MessagesModule,
  ],
  providers: [MessageService],
  templateUrl: './edit-book-form.component.html',
  styleUrl: './edit-book-form.component.css',
})
export class EditBookFormComponent implements OnInit, OnChanges {
  @Input() book!: Book;
  @Input() visible: boolean = false;

  @Output() bookUpdated = new EventEmitter<Book>();

  @ViewChild('fileUpload') fileUpload!: FileUpload;

  submited: boolean = false;

  editBookForm!: FormGroup;

  ngOnChanges(): void {
    if (this.book) {
      this.editBookForm.patchValue({
        title: this.book.title,
        author: this.book.author,
        rating: this.book.rating,
      });
    }
  }

  ngOnInit(): void {
    this.editBookForm = this.formBuilder.group({
      title: ['', [Validators.required]],
      author: ['', [Validators.required]],
      rating: [
        '',
        [Validators.required, Validators.minLength(1), Validators.maxLength(5)],
      ],
      image: ['', [Validators.required]],
    });
  }

  constructor(
    private formBuilder: FormBuilder,
    private message: MessageService,
    private bookService: BookService
  ) {}

  onSubmit(): void {
    this.submited = true;

    if (this.editBookForm.invalid) {
      Object.keys(this.editBookForm.controls).forEach((controlName) => {
        this.getMessageError(controlName);
      });
      this.submited = false;
      return;
    }

    const data: Book = { ...this.book, ...this.editBookForm.value };

    this.bookService.updateBook(data, this.book.id ?? '').subscribe({
      next: (response) => {
        this.message.add({
          severity: 'success',
          summary: 'Success',
          detail: 'Book updated successfully',
        });
        this.bookUpdated.emit(data);
        this.submited = false;
        this.visible = false;
        this.editBookForm.reset();
        this.fileUpload.clear();
      },
      error: (err) => {
        this.message.add({
          severity: 'error',
          summary: 'Error',
          detail: err.error.error,
        });
        this.fileUpload.clear();
        this.submited = false;
      },
    });
  }

  onUpload(event: any): void {
    const file = event.files[0];

    const reader = new FileReader();

    reader.onload = (e) => {
      const base64String = reader.result as string;

      this.editBookForm.patchValue({
        image: base64String,
      });
    };

    reader.readAsDataURL(file);
  }

  getMessageError(controlName: string): void {
    const control = this.editBookForm.get(controlName);

    if (control?.errors) {
      if (control?.errors['required']) {
        this.message.add({
          severity: 'warn',
          summary: 'Validation Error',
          detail: `The field (${controlName}) is required`,
        });
      } else if (control?.errors['email']) {
        this.message.add({
          severity: 'warn',
          summary: 'Validation Error',
          detail: `The field (${controlName}) must be a valid email`,
        });
      } else if (control?.errors['minlength']) {
        this.message.add({
          severity: 'warn',
          summary: 'Validation Error',
          detail: `The field (${controlName}) must be at least 5 characters`,
        });
      }
    }
  }
}
