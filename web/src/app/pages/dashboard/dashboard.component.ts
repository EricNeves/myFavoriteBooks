import { Component } from '@angular/core';

import { MenuBarComponent } from '@app/components/menu-bar/menu-bar.component';
import { BooksCardComponent } from '@app/components/books-card/books-card.component';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [MenuBarComponent, BooksCardComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css',
})
export class DashboardComponent {
  isVisibleCreateBookForm!: boolean;

  getEventOpenCreateBookForm(event: boolean): void {
    this.isVisibleCreateBookForm = event;
  }
}
