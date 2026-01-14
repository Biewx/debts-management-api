<?php

namespace App\Domain\Debts;

use DomainException;

class Debt
{
    private string $id;
    private string $description;
    private float $totalAmount;
    private string $status;

    public const STATUS_OPEN = 'OPEN';
    public const STATUS_PAID = 'PAID';

    public function __construct(
        string $id,
        string $description,
        float $totalAmount
    ) {
        if ($totalAmount <= 0) {
            throw new DomainException('Debt amount must be greater than zero.');
        }

        $this->id = $id;
        $this->description = $description;
        $this->totalAmount = $totalAmount;
        $this->status = self::STATUS_OPEN;
    }

    public function pay(): void
    {
        if ($this->status === self::STATUS_PAID) {
            throw new DomainException('Debt is already paid.');
        }

        $this->status = self::STATUS_PAID;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }
}