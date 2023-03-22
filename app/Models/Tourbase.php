<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tourbase extends Model
{
    use HasFactory,Searchable;

    protected $fillable = [
        'name',
        'description',
        'images',
        'coords',
        'rating'
    ];
    public function searchableAs()
    {
        return 'tourbases_index';
    }
}
