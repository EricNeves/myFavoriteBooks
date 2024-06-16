import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';
import { UserService } from '@app/services/user.service';

export const authenticatedGuard: CanActivateFn = (route, state) => {
  const userService = inject(UserService);
  const router = inject(Router);

  userService.getUser().subscribe({
    error: (error: any) => {
      if (error.status === 401) {
        router.navigate(['/']);
      }
    },
  });

  return true;
};
