<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class Customers extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'customers';


    /**
     * Scope a query to only include customers of a given store id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $store_id used to get customers by store id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStore($query, $store_id)
    {
        return $query->where('store_ref_id', new ObjectId($store_id));
    }

    public function scopeSearch($query, $value)
    {
        if (trim($value) == "") {
            return $query;
        }

        return $query->where('name', 'like', '%' . $value . '%');
    }

    public function transactions()
    {
        return $this->embedsMany(Transactions::class);
    }
}
