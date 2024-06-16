import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { User } from '@models/user.model';

import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private http: HttpClient) {}

  register(user: User): Observable<User> {
    return this.http.post<User>(
      `${environment.api.baseUrl}/users/register`,
      user
    );
  }

  login(user: User): Observable<User> {
    return this.http.post<User>(`${environment.api.baseUrl}/users/login`, user);
  }

  getUser(): Observable<User> {
    return this.http.get<User>(`${environment.api.baseUrl}/users/fetch`);
  }
}
