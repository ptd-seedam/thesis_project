import type { User } from './User';
import type { Book } from './Book';
import type { Fine } from './Fine';

export interface Borrowing {
  BR_ID: number;
  BR_DATE: Date | string;
  BR_DUE_DATE: Date | string;
  BR_RETURN_DATE?: Date | string | null;
  BR_STATUS: string;
  U_ID: number;
  B_ID: number;
  
  user?: User;
  book?: Book;
  fine?: Fine;
}