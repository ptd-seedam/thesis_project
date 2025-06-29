import type { User } from './User';
import type { Book } from './Book';
import type { Fine } from './Fine';

export interface Borrowing {
  BR_ID: number;
  BR_DATE: Date | string;
  BR_DUE_DATE: Date | string;
  BR_RETURN_DATE?: Date | string | null;
  BR_STATUS: string | null;
  U_ID: number | null;
  B_ID: number;
  
  user?: User;
  book?: Book;
  fine?: Fine;
}