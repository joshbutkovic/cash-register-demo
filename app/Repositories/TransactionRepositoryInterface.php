<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface TransactionRepositoryInterface
{
    public function all();
    public function create(Request $request);
    public function delete($id);
}
