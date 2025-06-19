<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id', 'quantity', 'total_price', 'payment_method', 'sale_date', 'employee_id', 'status'
    ];
} 