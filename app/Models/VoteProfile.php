<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteProfile extends Model
{
    use HasFactory;

    protected $table = 'vote_profiles';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vote_item_id',
        'icon',
        'title',
        'description',
        'gallery',
    ];

}
