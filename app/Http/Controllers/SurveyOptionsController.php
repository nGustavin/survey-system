<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey_option;

class SurveyOptionsController extends Controller
{
    public function index(){
        $options = survey_option::all();
        return response()->json($options, 200);
    }


    public function create(Request $request){
        $option = new Survey_option;
        $option->option_name = $request->input('option_name');
        $option->survey_id = $request->input('survey_id');

        if($option->save()) {
            return response()->json($option, 200);
        }
    }

    public function show($id){
        $option = survey_option::findOrFail($id);
        return response()->json($option, 200);
    }

    public function update(Request $request, $id) {
        $option = survey_option::findOrFail($id);
        $option->option_name = $request->input('option_name');
        $option->survey_id = $request->input('survey_id');

        if($option->save()) {
            return response()->json($option, 200);
        }
    }

    public function destroy($id){
        $option = survey_option::findOrFail($id);
        $option->delete();

        return response()->json($option, 200);
    }

    public function showAllOptionsBySurvey($id){
        $option = survey_option::where('survey_id', $id)->get();
        return response()->json($option, 200);
    }

    public function showAllOptionsNameBySurvey($id){
        $option = survey_option::where('survey_id', $id)->select('option_name')->get();
        $arr_options = array();

        foreach($option as $key){
            array_push($arr_options, ['option_name' => $key]);
        }
        
        return $option;
    }
}