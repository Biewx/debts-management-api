<?php

namespace App\Application\Debts;

use App\Domain\Debts\Debt;
use App\Domain\Debts\DebtRepository;

class CreateDebt
{
    public function __construct(
        private DebtRepository $repository
    ) {}

    public function execute(
        string $description,
        float $totalAmount
    ): void {
        $debt = new Debt(
            description: $description,
            totalAmount: $totalAmount,
            paidAmount: 0,
            status: Debt::STATUS_OPEN
        );

        $this->repository->save($debt);
    }
}