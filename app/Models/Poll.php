<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $tables = "polls";
    protected $primaryKey = "id_poll";
    protected $guarded = "";
    protected $keyType = "integer";

    public function votings(){
        return $this->hasMany(Voting::class,'id_poll');
    }

    public function result_polls(){
        return $this->hasMany(ResultPoll::class,'id_poll');
    }
}
