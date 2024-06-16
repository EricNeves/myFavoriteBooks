import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { InputTextModule } from 'primeng/inputtext';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';

import { User } from '@models/user.model';
import { UserService } from '@services/user.service';
import { Router } from '@angular/router';
import { LocalstorageService } from '@app/services/localstorage.service';

@Component({
  selector: 'app-auth-form',
  standalone: true,
  imports: [
    InputTextModule,
    ButtonModule,
    ToastModule,
    MessagesModule,
    ReactiveFormsModule,
  ],
  templateUrl: './auth-form.component.html',
  providers: [MessageService],
  styleUrl: './auth-form.component.css',
})
export class AuthFormComponent implements OnInit {
  submited: boolean = false;
  loginForm!: FormGroup;

  constructor(
    private message: MessageService,
    private router: Router,
    private userService: UserService,
    private formBuilder: FormBuilder,
    private localstorageService: LocalstorageService
  ) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(5)]],
    });
  }

  onSubmit(): void {
    this.submited = true;

    if (this.loginForm.invalid) {
      Object.keys(this.loginForm.controls).forEach((controlName) => {
        this.getMessageError(controlName);
      });
      this.submited = false;
      return;
    }

    const data: User = this.loginForm.value;

    this.userService.login(data).subscribe({
      next: (response: any) => {
        this.localstorageService.saveToken(response.data);
        this.router.navigate(['/dashboard']);
      },
      error: ({ error: responseError }: any) => {
        this.message.add({
          severity: 'error',
          summary: 'Error',
          detail: responseError.error,
        });
      },
    });
  }

  getMessageError(controlName: string): void {
    const control = this.loginForm.get(controlName);

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
