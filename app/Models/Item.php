<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Compra;

class Item extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'cat_items'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'at_no',
        'descripcion_compra',
        'descripcion',
        'max_cap',
    ];

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'cat_item_id');
    }
}
