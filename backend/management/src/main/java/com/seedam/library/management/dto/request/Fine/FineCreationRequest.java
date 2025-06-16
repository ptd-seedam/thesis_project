package com.seedam.library.management.dto.request.Fine;

import java.math.BigDecimal;
import java.time.LocalDate;

public class FineCreationRequest {
    private BigDecimal amount;
    private String reason;
    private LocalDate issuedDate;
    private String paidStatus;
    private String user_id;
    private String borrowing_id;

    public BigDecimal getAmount() {
        return amount;
    }

    public String getReason() {
        return reason;
    }

    public void setReason(String reason) {
        this.reason = reason;
    }

    public LocalDate getIssuedDate() {
        return issuedDate;
    }

    public void setIssuedDate(LocalDate issuedDate) {
        this.issuedDate = issuedDate;
    }

    public String getPaidStatus() {
        return paidStatus;
    }

    public void setPaidStatus(String paidStatus) {
        this.paidStatus = paidStatus;
    }

    public String getUser_id() {
        return user_id;
    }

    public void setUser_id(String user_id) {
        this.user_id = user_id;
    }

    public String getBorrowing_id() {
        return borrowing_id;
    }

    public void setBorrowing_id(String borrowing_id) {
        this.borrowing_id = borrowing_id;
    }

    public void setAmount(BigDecimal amount) {
        this.amount = amount;
    }
}
