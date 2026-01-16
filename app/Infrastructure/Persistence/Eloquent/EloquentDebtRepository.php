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
            (float) $model->paid_amount,
            $model->status
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

    public function listAll(): array
    {
        $debts = DebtModel::all()->toArray();
        $debtsList = [];

        foreach ($debts as $d) {
            $debt = new Debt(
                $d['description'],
                (float) $d['total_amount'],
                (float) $d['paid_amount'],
                $d['status']
            );

            $debt->setId($d['id']);
            $debtsList[] = $debt;
        }

        return $debtsList;
    }

    public function listByStatus(string $status): array
    {
        $debts = DebtModel::where('status', $status)->get();
        $debtsList = [];

        foreach ($debts as $d) {
            $debt = new Debt(
                $d['description'],
                (float) $d['total_amount'],
                (float) $d['paid_amount'],
                $d['status']
            );

            $debt->setId($d['id']);
            $debtsList[] = $debt;
        }

        return $debtsList;
    }

}