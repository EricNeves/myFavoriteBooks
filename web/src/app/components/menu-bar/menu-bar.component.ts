import { Component, OnInit } from '@angular/core';
import { MenuItem } from 'primeng/api';

import { MenubarModule } from 'primeng/menubar';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';

import { CreateBookFormComponent } from '@components/create-book-form/create-book-form.component';
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
  ],
  providers: [MessageService],
  templateUrl: './menu-bar.component.html',
  styleUrl: './menu-bar.component.css',
})
export class MenuBarComponent implements OnInit {
  visible: boolean = false;
  user: Partial<User> = {
    username: '',
  };

  items: MenuItem[] = [
    {
      label: 'Books',
      icon: 'pi pi-cloud-upload',
      command: () => {
        if (this.visible) {
          this.visible = false;
        }
      },
      items: [
        {
          label: 'New',
          icon: 'pi pi-plus',
          command: () => {
            if (this.visible) {
              this.visible = false;
            } else {
              this.visible = true;
            }
          },
        },
      ],
    },
  ];

  constructor(
    private message: MessageService,
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
}
