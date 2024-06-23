import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { MenuItem } from 'primeng/api';

import { MenubarModule } from 'primeng/menubar';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';

import { CreateBookFormComponent } from '@components/create-book-form/create-book-form.component';
import { EditProfileFormComponent } from '../edit-profile-form/edit-profile-form.component';

import { UserService } from '@app/services/user.service';
import { User } from '@app/models/user.model';
import { LocalstorageService } from '@app/services/localstorage.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menu-bar',
  standalone: true,
  imports: [
    MenubarModule,
    ButtonModule,
    ToastModule,
    MessagesModule,
    CreateBookFormComponent,
    EditProfileFormComponent,
  ],
  providers: [MessageService],
  templateUrl: './menu-bar.component.html',
  styleUrl: './menu-bar.component.css',
})
export class MenuBarComponent implements OnInit {
  @Output() onVisibleCreateBookForm = new EventEmitter<boolean>();
  isVisibleCreateBookForm: boolean = false;

  isVisibleEditProfileForm: boolean = false;

  user: Partial<User> = {
    username: '',
  };

  items: MenuItem[] = [
    {
      label: 'Books',
      icon: 'pi pi-cloud-upload',
      command: () => {
        this.onVisibleCreateBookForm.emit(false);
        this.isVisibleCreateBookForm = false;
      },
      items: [
        {
          label: 'New',
          icon: 'pi pi-plus',
          command: () => {
            this.isVisibleCreateBookForm = !this.isVisibleCreateBookForm;

            this.onVisibleCreateBookForm.emit(this.isVisibleCreateBookForm);
          },
        },
      ],
    },
    {
      label: 'Profile',
      icon: 'pi pi-user',
      command: () => {
        this.isVisibleEditProfileForm = this.isVisibleEditProfileForm = false;
      },
      items: [
        {
          label: 'Edit',
          icon: 'pi pi-pencil',
          command: () => {
            this.isVisibleEditProfileForm = !this.isVisibleEditProfileForm;
          },
        },
        {
          label: 'Logout',
          icon: 'pi pi-sign-out',
          command: () => {
            this.localStorage.removeToken();
            this.router.navigate(['/']);
          },
        },
      ],
    },
  ];

  constructor(
    private userService: UserService,
    private localStorage: LocalstorageService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.userService.getUser().subscribe({
      next: (user: any) => {
        this.user = user.data;
      },
      error: ({ error }) => {
        this.localStorage.removeToken();
        this.router.navigate(['/']);
      },
    });
  }

  onUserUpdated(updatedUser: User): void {
    this.user = { ...this.user, ...updatedUser };
  }
}
