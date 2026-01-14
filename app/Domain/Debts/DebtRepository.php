<?php

namespace App\Domain\Debts;

interface DebtRepository
{
    public function findById(string $id): Debt;

    public function save(Debt $debt): void;
}