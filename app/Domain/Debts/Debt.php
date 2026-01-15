<?php

namespace App\Domain\Debts;

use DomainException;

class Debt
{
    private ?int $id = null;
    private string $description;
    private float $totalAmount;
    private string $status;

    public const STATUS_OPEN = 'OPEN';
    public const STATUS_PAID = 'PAID';

    public function __construct(
        string $description,
        float $totalAmount
    ) {
        if ($totalAmount <= 0) {
            throw new DomainException('Debt amount must be greater than zero.');
        }

        $this->description = $description;
        $this->totalAmount = $totalAmount;
        $this->status = self::STATUS_OPEN;
    }

    // usado pelo repositório após salvar
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function pay(): void
    {
        if ($this->status === self::STATUS_PAID) {
            throw new DomainException('Debt is already paid.');
        }

        $this->status = self::STATUS_PAID;
    }
}