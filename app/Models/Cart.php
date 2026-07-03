<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options'
    ];

    protected static function booted() {}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(cart_item::class);
    }
}
