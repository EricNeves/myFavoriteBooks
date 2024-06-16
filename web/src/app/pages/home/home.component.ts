import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';

import { AuthFormComponent } from '@components/auth-form/auth-form.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [AuthFormComponent, FormsModule, RouterModule],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
})
export class HomeComponent {}
