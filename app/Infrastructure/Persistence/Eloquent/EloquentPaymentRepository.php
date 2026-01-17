<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Payments\Payment;
use App\Domain\Payments\PaymentRepository;

class EloquentPaymentRepository implements PaymentRepository
{
    public function save(Payment $payment): void
    {
        $model = PaymentModel::create([
            'amount' => $payment->getAmount(),
            'ocurred_at' => $payment->ocurredAt(),
            'debt_id' => $payment->getDebtId(),
        ]);
    }

    public function listByDebtId(string $id): array
    {
        return PaymentModel::where('debt_id', $id)->get()->toArray();
    }
}