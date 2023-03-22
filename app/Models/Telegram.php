<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    use HasFactory;

    protected $table = 'telegram_status';

    protected $fillable = [
        'status',
        'name',
        'user_id',
        'input'
    ];
}
