<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($name)
    {

        $users = User::with('types', 'products')->whereHas('types', function ($q) use ($name) {
            $q->where('name', $name);
        })->get();
        return response()->json([
            'success' => true,
            'results' => $users
        ]);
    }
}
