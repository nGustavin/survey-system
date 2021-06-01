<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\Survey_option;
use App\Models\Vote;

class VoteController extends Controller
{
    public function create(Request $request, $id){
        Survey::findOrFail($id);
        $option_id = $request->input('option_id');
        $option = Survey_option::findOrFail($option_id);
        
        $option->qtde++;
        $option->save();

        $vote = new Vote;
        $vote->option_id = $option_id;
        

        if($vote->save()){
            return response()->json($vote, 200);
        }
    }

    public function index(){
        $votes = Vote::all();
        return response()->json($votes, 200);
    }

    public function show($id){
        $vote = Vote::findOrFail($id);
        return response()->json($vote, 200);
    }

    public function update(Request $request, $id){
        $option_id = $request->input('option_id');
        Survey_option::findOrFail($option_id);
        $vote = Vote::findOrFail($id);
        $vote->option_id = $option_id;

        if($vote->save()){
            return response()->json($vote, 200);
        }
    }

    public function delete($id){
        $vote = Vote::findOrFail($id);
        $vote->delete();
        return response()->json("Deleted", 204);
    }

    public function getAllVotesFromOptions($id){
        $options = Survey_option::where('survey_id', $id)->select('qtde')->get();
        // foreach($options as $key){
        //     $format->option=$key;
        //     $myJson = json_encode($format);
        // }

        $votes = Vote::where('option_id', $options)->get();
        $results = count($votes);
        return response()->json($options, 200);
    }
}
