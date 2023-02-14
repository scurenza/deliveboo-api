<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = Order::where('product_id');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $form_data = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'max:255'],
        //     'phone_number' => ['required', 'numeric', 'max:13'],
        //     'address' => ['required', 'string', 'max:255']
        // ]);

        // if ($request->success === '1') {
        //     $form_data['success'] = 1;
        // } else {
        //     $form_data['success'] = 0;
        // }

        // $new_order = new Order();
        // $new_order->fill($form_data);
        // $new_order->save();
        $json = $request->all();
        // dd($json['products']);

        $tot = 0;

        foreach ($json['products'] as $product) {
            $tot += $product['price'] * $product['quantity'];
        }

        $form_data = [
            "name" => $json['name'],
            "last_name" => "Pluto",
            "email" => $json['email'],
            "phone_number" => 12345678,
            "address" => "Paperopoli",
            "amount" => $tot,
            "success" => 1,
            "date" => "2023-02-14"
        ];

        $order = Order::create($form_data);
        $products = $json['products'];



        foreach ($products as $product) {
            // $finalList[] = [
            //     $product['id'] => ['quantity' => $product['quantity']]
            // ];

            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }


        return response()->json([
            'success' => true,
            'results' => 'ordine inserito'
        ]);
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
