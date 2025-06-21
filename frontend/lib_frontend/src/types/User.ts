import type { Borrowing } from './Borrowing';
import type { Fine } from './Fine';

export interface User {
  U_ID: number;
  U_NAME: string;
  U_PHONE?: string;
  U_ADDRESS?: string;
  U_ROLE: string;
  U_TOKEN?: string;
  email?: string;
  password?: string;
  
  borrowings?: Borrowing[];
  fines?: Fine[];
}