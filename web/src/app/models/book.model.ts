export interface Book {
  id?: number | string;
  title: string;
  author: string;
  rating: number;
  image?: string;
  user_id?: number;
  book_id?: number;
  [key: string]: any;
}
