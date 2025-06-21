import type { User } from './User';
import type { Borrowing } from './Borrowing';

export interface Fine {
  F_ID: number;
  F_AMOUNT: number;
  F_REASON: string;
  F_ISSUED_DATE: Date | string;
  F_PAID_STATUS: boolean;
  U_ID: number;
  BR_ID: number;
  
  user?: User;
  borrowing?: Borrowing;
}