<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Item;

class Compra extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'item_register'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cat_item_id',
        'cantidad',
        'f_compra',
    ];

    public function item(): HasOne
    {
        return $this->hasOne(PersonaSSN::class, 'id', 'cat_item_id');
    }


}
