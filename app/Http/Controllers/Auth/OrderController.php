<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        // $orders::with('products')->whereHas('products', function ($query) {
        //     $query->where('user_id', 1);
        // })->get();

        // $orders = Order::with('products')->whereHas('products', function ($query) {
        //     $query->where('user_id', Auth::user()->id);
        // })->get();

        $orders = Order::with('products')->whereHas('products', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->orderBy('date', 'desc')->get();

        // return response()->json([
        //     'results' => $orders[0]
        // ]);


        return view('orders.index', compact('orders'));
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
        $json = $request->all();
        $form_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'max:9999999999999'],
            'success' => ['required'],
            'date' => ['required'],
            'amount' => ['required'],
            'address' => ['required', 'string', 'max:255']
        ]);

        $order = Order::create($form_data);
        $products = $json['products'];

        foreach ($products as $product) {
            $finalList[] = [
                $product['id'] => ['quantity' => $product['quantity'], 'user_id' => $product['user_id']]
            ];


            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        $id_user = $products[0]['user_id'];
        $user = User::find($id_user);



        $email = $form_data['email'];
        $messageData = [
            "name" => $form_data['name'],
            "last_name" => $form_data['last_name'],
            "amount" => $form_data['amount'],
            "email" => $form_data['email'],
            "phone_number" => $form_data['phone_number'],
            "address" => $form_data['address'],
            "user_name" => $user->name
        ];

        // Mail pagante
        Mail::send('emails.order', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Il tuo ordine è stato effetuato');
        });

        $email_sender = $user->email;
        // Mail esercente
        Mail::send('emails.order-user', $messageData, function ($message) use ($email_sender) {
            $message->to($email_sender)->subject('Hai ricevuto un nuovo ordine');
        });

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
