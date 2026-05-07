<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'id','name'
    ];
    use HasFactory;
    public function products() {
        return $this->belongsToMany(Product::class,'flag_products');
    }
}
