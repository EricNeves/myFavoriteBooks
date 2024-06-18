import { Component } from '@angular/core';
import { MenuItem } from 'primeng/api';

import { MenubarModule } from 'primeng/menubar';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { MessagesModule } from 'primeng/messages';

import { CreateBookFormComponent } from '@components/create-book-form/create-book-form.component';

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
export class MenuBarComponent {
  visible: boolean = false;

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

  constructor(private message: MessageService) {}
}
