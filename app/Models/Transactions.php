<?php

namespace App\Models;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class Transactions extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'transactions';

    public function scopeOfStore($query, $store_id)
    {
        if (trim($store_id) == "") {
            return $query;
        }

        return $query->where('store_ref_id', new ObjectId($store_id));
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
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

    public function scopeSearch($query, $value)
    {
        if (trim($value) == "") {
            return $query;
        }

        return $query->orWhere('description', 'like', '%' . $value . '%')
            ->orWhere('type', 'like', '%' . $value . '%')
            ->orWhere('amount', 'like', '%' . $value . '%')
            ->orWhere('total_amount', 'like', '%' . $value . '%')
            ->orWhere('date_recorded', 'like', '%' . $value . '%')
            ->orWhere('expected_pay_date', 'like', '%' . $value . '%');
    }
}
