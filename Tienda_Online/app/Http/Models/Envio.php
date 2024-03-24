<?php
namespace App\Http\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'direccion',
        'codigo_postal',
        'localidad',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
