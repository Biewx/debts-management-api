<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class DebtModel extends Model
{
    protected $table = 'debts';

    protected $fillable = [
        'id',
        'description',
        'total_amount',
        'status',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}