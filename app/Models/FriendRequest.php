<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    use HasFactory;

    public $table = 'friend_request';

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $guarded = ['id'];
}
