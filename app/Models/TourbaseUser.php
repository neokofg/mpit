<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourbaseUser extends Model
{
    use HasFactory;

    protected $table = 'tourbase_users';

    protected $fillable = [
        'tourbase_id',
        'user_id',
        'botStatus',
        'botUser'
    ];
}
