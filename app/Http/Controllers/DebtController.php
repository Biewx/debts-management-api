<?php

namespace App\Http\Controllers;

use App\Application\Debts\CreateDebt;
use App\Domain\Debts\Debt;
use App\Domain\Debts\DebtRepository;
use App\Domain\Payments\PaymentRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentDebtRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentPaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class DebtController extends Controller
{
    public function __construct(
        protected EloquentDebtRepository $repository
    ) {}
    
    private function mapping(array $debts){
        $result = [];

        foreach ($debts as $d){
            $debt = [
                "id" => $d->getId(),
                "description" => $d->getDescription(),
                "status" => $d->getStatus(),
                "paid_amount" => $d->getPaidAmount(),
                "total_amount" => $d->getTotalAmount()
            ];
            $result[] = $debt;
        } 

        return $result; 
    }

    private function getDebtByStatus(string $status){
        $debtsList = $this->repository->listByStatus($status);
        return $this->mapping($debtsList);
    }

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

    public function payDebt(Request $request, int $id, DebtRepository $repository, PaymentRepository $paymentRepository){
        $debt = $repository->findById($id);
        $amount = $request->input('amount');    
        $payment = $debt->pay($amount);
        $repository->update($debt);
        $paymentRepository->save($payment);
        
    }

    public function show(int $id, EloquentDebtRepository $repository){
        $debt = $repository->findById($id);

        return response()->json([
            "id" => $debt->getId(),
            "description" => $debt->getDescription(),
            "status" => $debt->getStatus(),
            "paid_amount" => $debt->getPaidAmount(),
            "total_amount" => $debt->getTotalAmount()
        ]);
        
    }

    public function list(EloquentDebtRepository $repository){
        $debtsList = $repository->listAll();
        return $this->mapping($debtsList);
    }

    public function listOpenDebts(){        
        return response()->json($this->getDebtByStatus(Debt::STATUS_OPEN));
    }
    public function listPartialDebts(){        
        return response()->json($this->getDebtByStatus(Debt::STATUS_PARTIAL));
    }
    public function listPaidDebts(){        
        return response()->json($this->getDebtByStatus(Debt::STATUS_PAID));
    }

}