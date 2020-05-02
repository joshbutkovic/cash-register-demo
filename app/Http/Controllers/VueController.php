<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function createTransaction(Request $request)
    {
        $amountDue = $request->provided - $request->due;
        $change = $this->getChange(abs($amountDue));

        return response()->json($change);
    }

    private function getChange($money)
    {
        $denominations = array(
            array("number" => 100, "name" => "hundreds"),
            array("number" => 50, "name" => "fifties"),
            array("number" => 20, "name" => "twenties"),
            array("number" => 5, "name" => "fives"),
            array("number" => 1, "name" => "ones"),
            array("number" => 0.25, "name" => "quarters"),
            array("number" => 0.10, "name" => "dimes"),
            array("number" => 0.050, "name" => "nickels"),
            array("number" => 0.010, "name" => "pennies"),
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

            $returnArr[$name] = $billsBack;
            $remainingMoney -= $billsBack * $number;
        }

        return $returnArr;
    }

}
