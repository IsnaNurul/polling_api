<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;
    protected $table = "votings";
    protected $primaryKey = "id_vote";
    protected $guarded = "";
    protected $keyType = "integer";

    public function polls(){
        return $this->belongsTo(Poll::class, 'id_poll');
    }

    public function resultpolls(){
        return $this->hasMany(ResultPoll::class,'id_vote');
    }
}
