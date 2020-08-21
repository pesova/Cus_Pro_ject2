<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Transactions extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'transactions';

    public function customer()
    {
        return $this->embedsOne(Customers::class, 'customer_ref_id');
    }

    public function scopePerCurrency($query, $type)
    {
        return $query->raw(function ($query) use ($type) {
            return $query->aggregate([
                ['$match' => ['type' => $type]],
                ['$group' => [
                    '_id' => '$currency',
                    'total_amount' => ['$sum' => '$amount'],
                    'total_interest' => ['$sum' => '$interest'],
                    'total_transactions' => ['$sum' => 1]
                ]]
            ]);
        });
    }
}
