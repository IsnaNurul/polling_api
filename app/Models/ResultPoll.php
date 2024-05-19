<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultPoll extends Model
{
    use HasFactory;
    protected $table = "result_polls";
    protected $primaryKey = "id_result";
    protected $guarded = "";
    // public $timestamps = false;

    public function votings(){
        return $this->belongsTo(Voting::class, 'id_vote');
    }

    public function users(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function polls(){
        return $this->belongsTo(Poll::class, 'id_poll');
    }
}
