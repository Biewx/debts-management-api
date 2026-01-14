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
            id: $model->id,
            description: $model->description,
            totalAmount: $model->total_amount
        );
    }

    public function save(Debt $debt): void
    {
        DebtModel::updateOrCreate(
            ['id' => $debt->getId()],
            [
                'description' => $debt->getDescription(),
                'total_amount' => $debt->getTotalAmount(),
                'status' => $debt->getStatus(),
            ]
        );
    }
}