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

  addBook(book: Book): Observable<{ data: Book }> {
    return this.http.post<{ data: Book }>(
      `${environment.api.baseUrl}/books/create`,
      book
    );
  }

  allBooks(): Observable<{ data: Book[] }> {
    return this.http.get<{ data: Book[] }>(
      `${environment.api.baseUrl}/books/all`
    );
  }

  updateBook(book: Book, bookID: number | string): Observable<Book> {
    return this.http.put<Book>(
      `${environment.api.baseUrl}/books/edit/${bookID}`,
      book
    );
  }

  deleteBook(bookID: number | string): Observable<{ data: Book }> {
    return this.http.delete<{ data: Book }>(
      `${environment.api.baseUrl}/books/remove/${bookID}`
    );
  }
}
