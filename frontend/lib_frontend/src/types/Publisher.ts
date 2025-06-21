import type { Book } from './Book';

export interface Publisher {
  P_ID: number;
  P_NAME: string;
  P_ADDRESS?: string;
  
  books?: Book[];
}