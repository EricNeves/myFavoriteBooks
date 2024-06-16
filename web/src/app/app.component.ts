import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';

import { StyleClassModule } from 'primeng/styleclass';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [StyleClassModule, RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent {
  title = 'My Favorite Books';
}
