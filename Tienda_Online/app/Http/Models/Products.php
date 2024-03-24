<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Products extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $hidden = ['created_at', 'updated_at'];

    public function categories(){
        return $this->hasOne( Category::class, 'id', 'category_id');
    }

}
