<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function all()
    {
        $transactions = $this->transactionRepository->all();
        return response()->json($transactions);
    }

    public function create(Request $request)
    {
        $change = $this->transactionRepository->create($request);
        return response()->json($change);
    }

    public function delete($id)
    {
        $res = $this->transactionRepository->delete($id);
        return response()->json($res);
    }
}
