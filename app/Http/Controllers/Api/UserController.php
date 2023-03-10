<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
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
        $restaurants = User::with('types')->paginate(3);
        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function show($name)
    {
        $users = User::with('types')->whereHas('types', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();


        return response()->json([
            'success' => true,
            'results' => $users
        ]);

        // $query = $request->query('type');
        // $array = explode(",", $query);

        // $users = [];
        // $arrayResult = [];
        // foreach ($array as $type) {

        //     $users[] = User::with('types', 'products')->whereHas('types', function ($q) use ($type) {
        //         $q->where('name', $type);
        //     })->get();
        // }
        // foreach ($users as $user) {
        //     foreach ($user as $restaurant) {
        //         if (!in_array($restaurant, $arrayResult)) {
        //             $arrayResult[] = $restaurant;
        //         }
        //     }
        // }
        // return response()->json([
        //     'success' => true,
        //     'results' => $arrayResult
        // ]);

        //----------------------------------------   

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

    public function getTypes()
    {
        $types = Type::all();
        return response()->json([
            'success' => true,
            'results' => $types
        ]);
    }

    public function getSingleType($name)
    {
        $users = User::with('types')->whereHas('types', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();

        if ($users->count() === 0) {
            return response()->json([
                'success' => false,
                'numberresults' => $users->count(),
                'message' => 'Non ci sono risultati'
            ]);
        }

        return response()->json([
            'success' => true,
            'numberresults' => $users->count(),
            'results' => $users
        ]);
    }

    public function getRestaurant($id)
    {
        $user = User::with('products')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'results' => $user
        ]);
    }

    public function multifilter(Request $request)
    {
        $query = $request->query('type');
        $category_name = explode(",", $query);
        $rest_list_match = [];
        $page = $request->query("page");
        $page = (int)$page;
        $users = User::with('types')->get();
        foreach ($users as $user) {
            if ($user->types()->whereIn('name', $category_name)->count() == count($category_name)) {
                $rest_list_match[] = $user;
            }
        }
        $skip_number = ($page - 1) * 3;
        $resultsRest = [];
        for ($i = 0; $i < 3; $i++) {
            if (count($rest_list_match) > $skip_number + $i) {
                $resultsRest[$i] = $rest_list_match[$skip_number + $i];
            }
        }

        $last_page = null;

        if (count($rest_list_match) >= $skip_number * 2) {
            $last_page = round(count($rest_list_match) / 3) + 1;
        }
        return response()->json([
            'success' => true,
            'results' => [
                'current_page' => $page,
                'last_page' => $last_page,
                'total' => count($rest_list_match),
                'data' => $resultsRest
            ]
        ]);
    }
}
