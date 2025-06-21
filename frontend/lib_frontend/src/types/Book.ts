import type { Author } from './Author';
import type { Category } from './Category';
import type { Publisher } from './Publisher';
import type { Borrowing } from './Borrowing';

export interface Book {
  B_ID: number;
  B_TITLE: string;
  B_PUBLIC_DATE: Date | string;
  B_TOTAL_COPIES: number;
  B_AVAILABLE_COPIES: number;
  B_RATE?: number;
  B_TOTAL_READ?: number;
  B_IMAGE?: string;
  C_ID: number;
  A_ID: number;
  P_ID: number;
  
  author?: Author;
  category?: Category;
  publisher?: Publisher;
  borrowings?: Borrowing[];
}