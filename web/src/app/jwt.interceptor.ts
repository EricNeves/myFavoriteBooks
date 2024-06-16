import { HttpInterceptorFn } from '@angular/common/http';
import { inject } from '@angular/core';
import { LocalstorageService } from './services/localstorage.service';

export const jwtInterceptor: HttpInterceptorFn = (req, next) => {
  const localstorage = inject(LocalstorageService);

  const token = localstorage.getToken();

  const reqAuth = req.clone({
    setHeaders: {
      Authorization: `Bearer ${token}`,
    },
  });

  return next(reqAuth);
};
