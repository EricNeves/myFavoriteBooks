export interface Book {
  id?: number | string;
  title: string;
  author: string;
  rating: number;
  image?: string;
  base64_image?: string;
  user_id?: number;
  [key: string]: any;
}
