<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'price' => ['required', 'decimal:2', 'min:0'],
            'img' => ['nullable', 'image', 'max:512'],
        ]);
        if ($request->available === '1') {
            $form_data['available'] = 1;
        } else {
            $form_data['available'] = 0;
        }

        if ($request->hasFile('img')) {
            $path = Storage::put('img', $request->img);
            $form_data['img'] = $path;
        };

        $form_data['user_id'] = Auth::user()->id;
        $new_product = new Product();
        $new_product->fill($form_data);
        $new_product->save();

        return redirect()->route('products.index')->with('message', "$new_product->name è stato creato con successo");
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
    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $form_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'price' => ['required', 'decimal:2', 'min:0'],
            'img' => ['nullable', 'image', 'max:512'],
        ]);
        dd($form_data);
        if ($request->available === '1') {
            $form_data['available'] = 1;
        } else {
            $form_data['available'] = 0;
        }

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::delete($product->img);
            }
            $path = Storage::put('img', $request->img);
            $form_data['img'] = $path;
        }
        $product->update($form_data);
        return redirect()->route('products.index')->with('message', "Hai modificato correttamente il prodotto $product->name");
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
