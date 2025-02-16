<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Review;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
         // Save users data
        $user = Auth::user();
        $user->update($request->except('total_cost'));

        // // Process checkout
        $code = 'ETP-' . mt_rand(0000000,999999);
        $carts = Cart::with(['product', 'user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        // Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'total_cost' => (int) $request->total_cost,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        $nickname = $request->nickname;
        $server_id = $request->server_id;
        $game_id = $request->game_id;
        $i = 0;


        
        foreach ($carts as $cart) {

                $transactiondetail = TransactionDetail::create([
                    'transactions_id' => $transaction->id,
                    'products_id' => $cart->product->id,
                    'nickname' => $nickname[$i],
                    'server_id' => $server_id[$i],
                    'game_id' => $game_id[$i],
                    'price' => $cart->product->price,
                    'shipping_status' => 'PENDING',
                    'code' => $code
                ]);
                
                Review::create([
                        'transaction_details_id' => $transactiondetail->id,
                        'transaction_id' => $transaction->id,
                        'products_id' => $cart->product->id,
                        'users_id' => Auth::user()->id,
                    ]);
                };
                $i++;

            foreach ( $request->nickname as $nickname ) {
                $transactiondetail->update(['nickname' => $nickname]);
            }
            
            foreach ( $request->server_id as $server_id ) {
                $transactiondetail->update(['server_id' => $server_id]);
            }
            foreach ( $request->game_id as $game_id ) {
                $transactiondetail->update(['game_id' => $game_id]);
            }   

        
        //Delete Cart Data
        Cart::where('users_id', Auth::user()->id)->delete();

        //Config Midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        
        //Make array to midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => (int) $request->total_cost,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
            'enabled_payments' => array(
                'gopay', 'bca_va', 'bank_transfer'
            ),
            'vtweb' => array()
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        try {
        // Get Snap Payment Page URL
        $paymentUrl = Snap::createTransaction($params)->redirect_url;
  
        // Redirect to Snap Payment Page
         return redirect($paymentUrl);
    }
        catch (Exception $e) {
        echo $e->getMessage();
    }
    
    }

     public function callback(Request $request)
     {

        try {
            
        // Set configuration midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Fhc3kYnLxOnr5-iBZCYlqZab';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Instance midtrans notification
        $notification = new Notification();

        // Assign to variable code
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;



        // Search transaction by ID
        $transaction = Transaction::where('code', $order_id)->firstOrFail();
        $transactiondetail = TransactionDetail::with('transaction')->where('transactions_id', $transaction->id);

        // Handle notification status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement') {
            $transaction->transaction_status = 'PAID';
            $transactiondetail->update(['shipping_status' => 'PROCESS']);
        }

        else if($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        }

        else if($status == 'deny') {
            $transaction->transaction_status = 'CANCELLED';
            $transactiondetail->update(['shipping_status' => 'CANCEL']);
        }

        else if($status == 'expired') {
            $transaction->transaction_status = 'CANCELLED';
            $transactiondetail->update(['shipping_status' => 'CANCEL']);
        }

        else if($status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
            $transactiondetail->update(['shipping_status' => 'CANCEL']);
        }

        // Save transaction
        $transaction->save();
 
        }   catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}