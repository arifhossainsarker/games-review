<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'price',
        'image',
        'user_id',
        'description'
    ];

    public function GamesReviews()
    {
        return $this->hasMany(GamesReview::class);
    }
}
