import { Component, Input, OnInit } from '@angular/core';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { FileUploadModule } from 'primeng/fileupload';
import { DialogModule } from 'primeng/dialog';
import { InputTextModule } from 'primeng/inputtext';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';
import { RatingModule } from 'primeng/rating';
import { Book } from '@app/models/book.model';
import { BookService } from '@app/services/book.service';

@Component({
  selector: 'app-create-book-form',
  standalone: true,
  imports: [
    ReactiveFormsModule,
    DialogModule,
    InputTextModule,
    ButtonModule,
    ToastModule,
    MessagesModule,
    RatingModule,
    FileUploadModule,
  ],
  providers: [MessageService],
  templateUrl: './create-book-form.component.html',
  styleUrl: './create-book-form.component.css',
})
export class CreateBookFormComponent implements OnInit {
  @Input() visible: boolean = false;

  submited: boolean = false;
  createBookForm!: FormGroup;

  ngOnInit(): void {
    this.createBookForm = this.formBuilder.group({
      title: ['', [Validators.required]],
      author: ['', [Validators.required]],
      rating: [
        '',
        [Validators.required, Validators.minLength(1), Validators.maxLength(5)],
      ],
      base64_image: ['', [Validators.required]],
    });
  }

  constructor(
    private formBuilder: FormBuilder,
    private message: MessageService,
    private bookService: BookService
  ) {}

  onSubmit(): void {
    this.submited = true;

    if (this.createBookForm.invalid) {
      Object.keys(this.createBookForm.controls).forEach((controlName) => {
        this.getMessageError(controlName);
      });
      this.submited = false;
      return;
    }

    const data: Book = this.createBookForm.value;

    this.bookService.addBook(data).subscribe({
      next: ({ data: Book }) => {
        this.message.add({
          severity: 'success',
          summary: 'Success',
          detail: 'Book added successfully',
        });
        this.submited = false;
        this.createBookForm.reset();
        this.visible = false;
      },
      error: ({ error: responseError }: any) => {
        this.message.add({
          severity: 'error',
          summary: 'Error',
          detail: responseError.error,
        });
        this.submited = false;
        return;
      },
    });
  }

  onUpload(event: any): void {
    const file = event.files[0];

    const reader = new FileReader();

    reader.onload = (e) => {
      const base64String = reader.result as string;

      this.createBookForm.patchValue({
        base64_image: base64String,
      });
    };

    reader.readAsDataURL(file);
  }

  getMessageError(controlName: string): void {
    const control = this.createBookForm.get(controlName);

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
