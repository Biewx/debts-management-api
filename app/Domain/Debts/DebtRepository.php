<?php

namespace App\Domain\Debts;

interface DebtRepository
{
    public function findById(int $id): Debt;

    public function save(Debt $debt): void;
}