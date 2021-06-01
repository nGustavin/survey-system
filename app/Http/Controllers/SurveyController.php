<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\Survey_option;

class SurveyController extends Controller
{
    public function getSurveys(){
        return response()->json(survey::all(), 200);
    }

    public function getSurveyById($id){
        $selectedSurvey = survey::find($id);
        if(is_null($selectedSurvey)){
            return response()->json(["Message" => "Survey not found"], 404);
        }

        return response()->json($selectedSurvey::find($id), 200);
    }

    public function createSurvey(Request $request){
        $survey = new Survey;
        $survey->name = $request->input('name');
        $survey->description = $request->input('description');
        $survey->status = $request->input('status');
        $survey->start = $request->input('start');
        $survey->end = $request->input('end');
        $options = $request->input('survey_options');
        $arr_options = array();

        foreach ($options as $key) {
            array_push($arr_options, ['option_name' => $key]);
        }

        if ($survey->save()) {
            $survey->surveyOptions()->createMany($arr_options);
            $data = array(
                'survey_id' => $survey->survey_id
            );
            return response()->json($survey, 203);
        }
    }


    public function deleteSurvey($id){
        $selectedSurvey = survey::find($id);
        if(is_null($selectedSurvey)){
            return response()->json(["Message" => "Survey not found"], 404);
        }
        
        $selectedSurvey->delete();

        return response()->json(["Message" => "Survey has been deleted"], 204);
    }

    public function editSurvey(Request $request, $id){
        $selectedSurvey = survey::find($id);

        if(is_null($selectedSurvey)){
            return response()->json(["Message" => "Survey not found"], 404);
        }

        $selectedSurvey->update($request->all());

        return response()->json($selectedSurvey, 200);
    }

    public function getOpenSurveys(){
        $openSurveys = Survey::where('status', 1)->get();
        return response()->json($openSurveys);
    }

    public function getFinalizedSurveys(){
        $finalizedSurveys = Survey::where('status', 2)->get();
        return response()->json($finalizedSurveys);
    }

    public function getNotStatedSurveys(){
        $notStatedSurveys = Survey::where('status', 3)->get();
        return response()->json($notStatedSurveys);
    }
}
