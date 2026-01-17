<?php

namespace App\Domain\Payments;

interface PaymentRepository
{
    public function save(Payment $payment): void;
    public function listByDebtId(string $id): array;
    
}