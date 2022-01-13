<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public $table = 'transaction_detail';

    public function header() {
        return $this->hasOne(TransactionHeader::class);
    }

    public function game() {
        return $this->hasOne(Game::class);
    }

    protected $guarded = ['id'];
}
