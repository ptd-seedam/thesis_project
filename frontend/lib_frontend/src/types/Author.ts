import type { Book } from './Book';

export interface Author {
  A_ID: number;
  A_NAME: string;
  A_DESCRIPTION?: string;
  books?: Book[]; // Quan hệ hasMany
}