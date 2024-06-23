import {
  Component,
  Input,
  OnInit,
  OnChanges,
  Output,
  EventEmitter,
  SimpleChanges,
} from '@angular/core';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { DialogModule } from 'primeng/dialog';
import { InputTextModule } from 'primeng/inputtext';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';

import { UserService } from '@app/services/user.service';

import { User } from '@app/models/user.model';

@Component({
  selector: 'app-edit-profile-form',
  standalone: true,
  imports: [
    ReactiveFormsModule,
    DialogModule,
    InputTextModule,
    ButtonModule,
    ToastModule,
    MessagesModule,
  ],
  providers: [MessageService],
  templateUrl: './edit-profile-form.component.html',
  styleUrl: './edit-profile-form.component.css',
})
export class EditProfileFormComponent implements OnInit, OnChanges {
  @Input() visible: boolean = false;
  @Input() user!: Partial<User>;
  @Output() userUpdated = new EventEmitter<User>();

  submited: boolean = false;

  editProfileForm!: FormGroup;

  constructor(
    private formBuilder: FormBuilder,
    private message: MessageService,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.editProfileForm = this.formBuilder.group({
      username: [this.user.username, Validators.required],
    });
  }

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['user']) {
      this.updateForm();
    }
  }

  private updateForm(): void {
    if (
      this.editProfileForm &&
      this.editProfileForm.get('username')?.value !== this.user.username
    ) {
      this.editProfileForm.patchValue({
        username: this.user.username,
      });
    }
  }

  onSubmit(): void {
    this.submited = true;

    if (this.editProfileForm.invalid) {
      Object.keys(this.editProfileForm.controls).forEach((controlName) => {
        this.getMessageError(controlName);
      });
      this.submited = false;
      return;
    }

    const data: User = this.editProfileForm.value;

    this.userService.updateUser(data).subscribe({
      next: (response) => {
        this.message.add({
          severity: 'success',
          summary: 'Success',
          detail: 'Profile updated successfully',
        });

        this.userUpdated.emit(response.data);

        this.submited = false;
        this.visible = false;
      },
      error: (err) => {
        this.message.add({
          severity: 'error',
          summary: 'Error',
          detail: err.error.message,
        });

        this.submited = false;
        this.visible = false;
      },
    });
  }

  getMessageError(controlName: string): void {
    const control = this.editProfileForm.get(controlName);

    if (control?.errors) {
      if (control?.errors['required']) {
        this.message.add({
          severity: 'warn',
          summary: 'Validation Error',
          detail: `The field (${controlName}) is required`,
        });
      }
    }
  }
}
