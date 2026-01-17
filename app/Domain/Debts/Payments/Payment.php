<?php

final class Payment{
    private float $amount;
    private DateTimeImmutable $ocurredAt;
    private string $debtId;

    public function __construct(
        float $amount,
        ?DateTimeImmutable $ocurredAt = null,
        string $debtId
    ){
        if($amount <= 0){
            throw new DomainException('Payment amount must be greater than zero.');
        }

        $this->amount = $amount;
        $this->ocurredAt = $ocurredAt;
        $this->debtId = $debtId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDebtId(): string
    {
        return $this->debtId;
    }

    public function ocurredAt(): DateTimeImmutable
    {
        return $this->ocurredAt;
    }
}