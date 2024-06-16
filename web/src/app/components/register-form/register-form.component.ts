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

@Component({
  selector: 'app-register-form',
  standalone: true,
  imports: [
    InputTextModule,
    ButtonModule,
    ReactiveFormsModule,
    ToastModule,
    MessagesModule,
  ],
  providers: [MessageService],
  templateUrl: './register-form.component.html',
  styleUrl: './register-form.component.css',
})
export class RegisterFormComponent implements OnInit {
  registerForm!: FormGroup;
  submited: boolean = false;

  constructor(
    private formBuilder: FormBuilder,
    private message: MessageService,
    private userService: UserService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      username: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(5)]],
    });
  }

  onSubmit(): void {
    this.submited = true;

    if (this.registerForm.invalid) {
      Object.keys(this.registerForm.controls).forEach((controlName) => {
        this.getMessageError(controlName);
      });
      this.submited = false;
      return;
    }

    const data: User = this.registerForm.value;

    this.userService.register(data).subscribe({
      next: (response: any) => {
        this.message.add({
          severity: 'success',
          summary: 'Success',
          detail: response.data,
        });
        this.submited = false;
        this.router.navigate(['/']);
      },
      error: ({ error: responseError }: any) => {
        this.message.add({
          severity: 'error',
          summary: 'Error',
          detail: responseError.error,
        });
        this.submited = false;
      },
    });
  }

  getMessageError(controlName: string): void {
    const control = this.registerForm.get(controlName);

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
