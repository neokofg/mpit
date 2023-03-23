<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'rating',
        'location',
        'classification'
    ];
    public function getFirstImage(): ?string
    {
        $images = json_decode($this->images, true);

        if (is_array($images) && isset($images[0]) && isset($images[0]['name'])) {
            return $images[0]['name'];
        }

        return null;
    }
    public function searchableAs()
    {
        return 'tourbases_index';
    }
    public function scopeSearch(Builder $query, $searchTerm)
    {
        return $query->where(function (Builder $query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('classification', 'LIKE', '%' . $searchTerm . '%');
        });
    }
}
