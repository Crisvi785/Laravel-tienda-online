<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['id', 'user_id'];
}
