<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    
        protected $fillable = ['product_slug', 'quantity', 'total_price'];
    
}

