<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    protected $table = 'notification';

    protected $fillable = [
        'user_id',
        'message',
        'status',
        'datetime'
    ];

    public $timestamps = false;

    // Each notification belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}