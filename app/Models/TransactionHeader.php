<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    public $table = 'transaction_header';

    public function details() {
        return $this->hasMany(TransactionDetail::class);
    }

    protected $guarded = ['id'];
}
