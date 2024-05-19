<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ResultPoll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultPollController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function cek(Request $request){

        $result = ResultPoll::where('id_user',$request->id_user)
        ->where('id_poll', $request->id_poll)
        ->get(); 

        if($result->count()>0){
            return response()->json([
                'status' => "found",
                'result' => $result
            ]);
        }else{
            return response()->json([
                'status' => "failed"
            ]);
        }
    }

    public function create(Request $request){
        $request->validate([
            'id_user' => 'required',
            'id_vote' => 'required',
            'id_poll' => 'required',
        ]);
        
        $result = ResultPoll::create([
            'id_user' => $request->id_user,
            'id_vote' => $request->id_vote,
            'id_poll' => $request->id_poll,
        ]);

        return response()->json([
            'status' => 'success',
            'result' => $result,
        ]);
    }

    public function resultshow(){
        return response()->json([
            'status' => 'success',
            'result' => ResultPoll::all()
        ]);
    }
}
