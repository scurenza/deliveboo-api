<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'last_name', 'email', 'phone_number', 'address', 'amount', 'success', 'date'];
    use HasFactory;
}
