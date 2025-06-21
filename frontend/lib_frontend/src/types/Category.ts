import type { Book } from './Book';

export interface Category {
  C_ID: number;
  C_NAME: string;
  C_DESCRIPTION?: string;
  
  books?: Book[];
}