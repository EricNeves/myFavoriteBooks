import { Component } from '@angular/core';

import { RouterModule } from '@angular/router';

import { RegisterFormComponent } from '@app/components/register-form/register-form.component';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [RegisterFormComponent, RouterModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css',
})
export class RegisterComponent {}
