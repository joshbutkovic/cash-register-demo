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
        $transaction->hundreds = isset($changeObj->Hundreds) ? $changeObj->Hundreds : 0;
        $transaction->fifties = isset($changeObj->Fifties) ? $changeObj->Fifties : 0;
        $transaction->twenties = isset($changeObj->Twenties) ? $changeObj->Twenties : 0;
        $transaction->fives = isset($changeObj->Fives) ? $changeObj->Fives : 0;
        $transaction->ones = isset($changeObj->Ones) ? $changeObj->Ones : 0;
        $transaction->quarters = isset($changeObj->Quarters) ? $changeObj->Quarters : 0;
        $transaction->dimes = isset($changeObj->Dimes) ? $changeObj->Dimes : 0;
        $transaction->nickels = isset($changeObj->Nickels) ? $changeObj->Nickels : 0;
        $transaction->pennies = isset($changeObj->Pennies) ? $changeObj->Pennies : 0;
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

    public function delete($id)
    {
        Transaction::destroy($id);
    }

}
