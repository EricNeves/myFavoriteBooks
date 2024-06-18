import { Component } from '@angular/core';

import { MenuBarComponent } from '@app/components/menu-bar/menu-bar.component';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [MenuBarComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css',
})
export class DashboardComponent {}
