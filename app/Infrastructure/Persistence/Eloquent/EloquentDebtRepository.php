<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Debts\Debt;
use App\Domain\Debts\DebtRepository;

class EloquentDebtRepository implements DebtRepository
{
    public function findById(int $id): Debt
    {
        $model = DebtModel::findOrFail($id);

        $debt = new Debt(
            $model->description,
            (float) $model->total_amount,
            (float) $model->paid_amount
        );


        $debt->setId($model->id);

        return $debt;
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

    public function update(Debt $debt): void
    {

        DebtModel::where('id', $debt->getId())->update([
            'status' => $debt->getStatus(),
            'paid_amount' => $debt->getPaidAmount()
        ]);
    }

}