<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $product_id = $request->input('product_id');
        $status = $request->input('status');

        if($id)
        {
            $transaction = Transactions::with(['product','user'])->find($id);

            if($transaction)
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
        }

        $transaction = Transactions::with(['product','user'])->where('user_id', Auth::user()->id);

        if($product_id)
            $transaction->where('product_id', $product_id);

        if($status)
            $transaction->where('status', $status);

        return ResponseFormatter::success(
            $transaction->get(),
            'Data list transaksi berhasil diambil'
        );
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
            'courier_type' => 'required',
            'courier_price' => 'required',
        ]);

        $transaction = Transactions::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'status' => $request->status,
            'courier_type' => $request->courier_type,
            'courier_price' => $request->courier_price,
            //'payment' => $request->file('payment')->store('assets/payment', 'public')
        ]);

        $transaction = Transactions::with(['product','user'])->find($transaction->id);

        $transaction->save();

        return ResponseFormatter::success($transaction,'Transaksi berhasil');
    }

}
