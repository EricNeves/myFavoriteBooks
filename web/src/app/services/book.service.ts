import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Book } from '@app/models/book.model';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class BookService {
  constructor(private http: HttpClient) {}

  addBook(book: Book): Observable<Book> {
    return this.http.post<Book>(
      `${environment.api.baseUrl}/books/create`,
      book
    );
  }
}
