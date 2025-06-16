<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'nome',
        'produto_id',
        'valor',
        'data',
        'status',
        'quantidade',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
