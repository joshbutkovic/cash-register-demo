<?php

namespace App\Repositories;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
        return Transaction::all();
    }

    public function create(Request $request)
    {
        $amountDue = $request->provided - $request->due;

        if ($amountDue < 0) {
            return response()
                ->json('You did not enter enough money for the sale.')
                ->setStatusCode(400);
        }

        $change = $this->getChange(abs($amountDue));
        $changeObj = (object) $change;

        $transaction = new Transaction;
        $transaction->due = $request->due;
        $transaction->provided = $request->provided;
        $transaction->hundreds = isset($changeObj->hundreds) ? $changeObj->hundreds : 0;
        $transaction->fifties = isset($changeObj->fifties) ? $changeObj->fifties : 0;
        $transaction->twenties = isset($changeObj->twenties) ? $changeObj->twenties : 0;
        $transaction->fives = isset($changeObj->fives) ? $changeObj->fives : 0;
        $transaction->ones = isset($changeObj->ones) ? $changeObj->ones : 0;
        $transaction->quarters = isset($changeObj->quarters) ? $changeObj->quarters : 0;
        $transaction->dimes = isset($changeObj->dimes) ? $changeObj->dimes : 0;
        $transaction->nickels = isset($changeObj->nickels) ? $changeObj->nickels : 0;
        $transaction->pennies = isset($changeObj->pennies) ? $changeObj->pennies : 0;
        $transaction->save();

        return $change;
    }

    private function getChange($money)
    {
        $denominations = array(
            array("number" => 100, "name" => "Hundreds"),
            array("number" => 50, "name" => "Fifties"),
            array("number" => 20, "name" => "Twenties"),
            array("number" => 5, "name" => "Fives"),
            array("number" => 1, "name" => "Ones"),
            array("number" => 0.25, "name" => "Quarters"),
            array("number" => 0.10, "name" => "Dimes"),
            array("number" => 0.050, "name" => "Nickels"),
            array("number" => 0.010, "name" => "Pennies"),
        );

        $returnArr = [];
        $remainingMoney = $money;

        for ($i = 0; $i < count($denominations); $i++) {
            $name = $denominations[$i]['name'];
            $number = $denominations[$i]['number'];

            if ($remainingMoney < 1) {
                round($remainingMoney, 2);
            }

            $billsBack = $remainingMoney < 1 ?
            floor(round($remainingMoney, 2) / $number) :
            floor($remainingMoney / $number);

            if ($billsBack > 0) {
                $returnArr[$name] = $billsBack;
            }

            $remainingMoney -= $billsBack * $number;
        }

        return $returnArr;
    }

    // public function deleteAll($transaction_id)
    // {
    //     Transaction::destroy($transaction_id)
    // }

}
