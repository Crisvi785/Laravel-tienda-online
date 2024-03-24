<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['id', 'quantity', 'product_slug', 'product_id', 'cart_id'];
}