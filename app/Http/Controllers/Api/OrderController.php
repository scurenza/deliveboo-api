<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(OrderRequest $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];
        return response()->json($data, 200);
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        $result = $gateway->transaction()->sale([
            'amount' => '12.00',
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        if ($result->success) {
            $data = [
                'success' => true,
                'message' => "Transazione eseguita"
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => "Transazione fallita"
            ];
            return response()->json($data, 401);
        }
    }
}
