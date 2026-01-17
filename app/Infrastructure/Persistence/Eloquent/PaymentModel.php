<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'ocurred_at',
        'amount',
        'debt_id',

    ];
}