import { Routes } from '@angular/router';

import { authenticatedGuard } from './guards/authenticated.guard';

import { HomeComponent } from '@pages/home/home.component';
import { RegisterComponent } from '@pages/register/register.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';

export const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'register', component: RegisterComponent },
  {
    path: 'dashboard',
    component: DashboardComponent,
    canActivate: [authenticatedGuard],
  },
];
