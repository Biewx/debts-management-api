<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Debts\Debt;
use App\Domain\Debts\DebtRepository;

class EloquentDebtRepository implements DebtRepository
{
    public function findById(string $id): Debt
    {
        $model = DebtModel::findOrFail($id);

        return new Debt(
            
            description: $model->description,
            totalAmount: $model->total_amount
        );
    }

    public function save(Debt $debt): void
{
    $model = DebtModel::create([
        'description' => $debt->getDescription(),
        'total_amount' => $debt->getTotalAmount(),
        'status' => $debt->getStatus(),
    ]);

    $debt->setId($model->id);
}
}