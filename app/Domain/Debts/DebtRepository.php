<?php

namespace App\Domain\Debts;

interface DebtRepository
{
    public function findById(int $id): Debt;
    public function save(Debt $debt): void;
    public function update(Debt $debt): void;
    public function listAll(): array;
    public function listByStatus(string $status): array;
}