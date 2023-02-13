<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function index(User $user)
    {

        // $users = User::with('types', 'products')->whereHas('types', function ($q) use ($name) {
        //     $q->where('name', $name);
        // })->get();
        // return response()->json([
        //     'success' => true,
        //     'results' => $users
        // ]);
        $restaurants = User::all();
        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function show(Request $request)
    {
        $query = $request->query('type');
        $array = explode(",", $query);

        $users = [];
        $arrayResult = [];
        foreach ($array as $type) {

            $users[] = User::with('types', 'products')->whereHas('types', function ($q) use ($type) {
                $q->where('name', $type);
            })->get();
        }
        foreach ($users as $user) {
            foreach ($user as $restaurant) {
                if (!in_array($restaurant, $arrayResult)) {
                    $arrayResult[] = $restaurant;
                }
            }
        }
        return response()->json([
            'success' => true,
            'results' => $arrayResult
        ]);


        // QUERY PER CHIAMATA API

        // $users = User::with('types')->whereHas('types', function ($query) use ($array) {
        //     foreach ($array as $name) {
        //         $query->where('name', $name);
        //     }
        // })->get();

        // return response()->json([
        //     'success' => true,
        //     'results' => $users
        // ]);
    }
}
