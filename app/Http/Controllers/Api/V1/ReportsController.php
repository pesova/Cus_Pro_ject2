<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\TransactionCollection;
use App\Models\Stores;
use App\Models\Transactions;
use Exception;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function StoreReport(Request $request, $store_id)
    {

        $length = (int) $request->get('length') ?? 10;
        $result = [];

        try {
            $paidTransactionReport = Transactions::groupby('currency')->perCurrency('paid');
            $debtTransactionReport = Transactions::groupby('currency')->perCurrency('debt');
            $creditTransactionReport = Transactions::groupby('currency')->perCurrency('credit');
            // $creditDebtTransactionReport = Transactions::groupby('currency')->perCurrency('credit_ebt');

            $latestTransactions = Transactions::orderBy('date_recorded', 'desc')
                ->take($length)
                ->get();

            $store = Stores::find($store_id);
            $result = [
                'debts' => $debtTransactionReport,
                'paids' => $paidTransactionReport,
                'credits' => $creditTransactionReport,
                'latest_transactions' => (new TransactionCollection($latestTransactions)),
            ];
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'failed',
                'message' => 'failed to get resources',
                'data'    => ['description' => $e->getMessage()]
            ], 400);
        }

        return (new ReportCollection($result))->additional([
            '_id' => $store->_id,
            'store_name' => $store->store_name,
            'shop_address' => $store->shop_address,
            'tagline' => $store->tagline,
            'phone_number' => $store->phone_number,
            'email' => $store->email,
        ]);
    }
}
