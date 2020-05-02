<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
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

        // Insert Record
        $transaction = new Transaction;
        $transaction->due = 34.44;
        $transaction->provided = 44.44;
        echo $change;
        // $transaction->hundreds = $change['hundreds'];
        // $transaction->fifties = $change['fifties'];
        // $transaction->twenties = $change['twenties'];
        // $transaction->fives = $change['fives'];
        // $transaction->ones = $change['ones'];
        // $transaction->quarters = $change['quarters'];
        // $transaction->dimes = $change['dimes'];
        // $transaction->nickels = $change['nickels'];
        // $transaction->pennies = $change['pennies'];

        $transaction->save();

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

            if ($billsBack > 0) {
                $returnArr[$name] = $billsBack;
            }

            $remainingMoney -= $billsBack * $number;
        }

        return $returnArr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
