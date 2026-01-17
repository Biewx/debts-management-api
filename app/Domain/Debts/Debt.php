<?php

namespace App\Domain\Debts;

use App\Domain\Payments\Payment;
use DomainException;


class Debt
{
    private ?int $id = null;
    private string $description;
    private float $totalAmount;
    private float $paidAmount = 0;
    private string $status;

    public const STATUS_OPEN = 'OPEN';
    public const STATUS_PAID = 'PAID';
    public const STATUS_PARTIAL = 'PARTIAL';

    public function __construct(
        string $description,
        float $totalAmount,
        float $paidAmount = 0,
        string $status
    ) {
        if ($totalAmount <= 0) {
            throw new DomainException('Debt amount must be greater than zero.');
        }
        $this->description = $description;
        $this->totalAmount = $totalAmount;
        $this->paidAmount = $paidAmount;
        $this->status = $status;

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
    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    

    public function pay(float $amount): Payment
    {
        if ($this->status === self::STATUS_PAID) {
            throw new DomainException('Debt is already paid.');
        }

        if ($this->paidAmount + $amount > $this->totalAmount) {
            throw new DomainException('Payment exceeds total debt amount.');
        }

        $this->paidAmount += $amount;

        if (abs($this->paidAmount - $this->totalAmount) < 0.01) {
            $this->status = self::STATUS_PAID;
        } else {
            $this->status = self::STATUS_PARTIAL;
        }

        $payment = new Payment($amount, new \DateTimeImmutable(), $this->id);

        return $payment;


    }
}