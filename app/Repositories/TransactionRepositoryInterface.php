<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface TransactionRepositoryInterface
{
    // public function get($post_id);
    public function all();
    public function create(Request $request);
    // public function delete($post_id);
    // public function update($post_id, array $post_data);
}
