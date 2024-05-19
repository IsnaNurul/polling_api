<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;

class VotingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request){
        $request->validate([
            'vote' => 'required|string',
            'id_poll' => 'required|string',
        ]);

        $voting = Voting::create([
            'vote' => $request->vote,
            'id_poll' => $request->id_poll,
        ]);

        return response()->json([
            'status' => 'success',
            'voting' => $voting,
        ]);
    }
}
