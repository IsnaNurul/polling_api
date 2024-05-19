<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;

class PollController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'date',
        ]);

        $poll = Poll::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return response()->json([
            'status' => 'success',
            'poll' => $poll,
            
        ]);
    }

    public function show(){
        return response()->json([
            'status' => 'success',
            'Polls' => Poll::with('votings')->get()
        ]);
    }

    public function showvote(Request $request){
        return response()->json([
            'status' => 'success',
            'Polls' => Poll::with('votings')->find($request->id_poll)
        ]);
    }

 

    public function delete($id_poll){
        $poll = Poll::find($id_poll);

        if ($poll->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Poll deleted success'
            ]);
        }
    }
}
