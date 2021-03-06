<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'game';

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class);
    }

    protected $guarded = ['id'];
}


