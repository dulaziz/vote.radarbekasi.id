<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VoteItem;

class Voting extends Model
{
    use HasFactory;

    protected $table = 'votings';


    protected $fillable = [
        'user_vote',
        'vote_unit_id',
        'vote_item_id',
    ];

    // public function voteItem(){
    //     return $this->belongsTo(VoteItem::class);
    // }

    public function voteItem(){
        return $this->belongsTo(VoteItem::class);
    }

    public function voteUnit(){
        return $this->hasOne(VoteUnit::class,'id','vote_unit_id');
    }

}
