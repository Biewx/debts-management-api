<?php

namespace App\Http\Controllers;

use App\Application\Debts\CreateDebt;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class DebtController extends Controller
{
    public function store(Request $request, CreateDebt $createDebt)
    {
        $data = $request->validate([
            'description' => 'required|string',
            'total_amount' => 'required|numeric|min:0.01',
        ]);

        $createDebt->execute(
            description: $data['description'],
            totalAmount: $data['total_amount']
        );

        return response()->json(null, Response::HTTP_CREATED);
    }
}