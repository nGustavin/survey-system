<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyOptionsController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Survey Routes
Route::get('/surveys', [SurveyController::class, 'getSurveys']);

Route::get('/surveys/open', [SurveyController::class, 'getOpenSurveys']); // status: 1
Route::get('/surveys/closed', [SurveyController::class, 'getFinalizedSurveys']); // status: 2
Route::get('/surveys/not-started', [SurveyController::class, 'getNotStatedSurveys']); // status: 3

Route::get('/survey/{id}', [SurveyController::class, 'getSurveyById']);
Route::post('/create-survey', [SurveyController::class, 'createSurvey']);
Route::put('/survey/{id}', [SurveyController::class, 'editSurvey']);
Route::delete('/survey/{id}', [SurveyController::class, 'deleteSurvey']);


// Options Routes
Route::get('/options', [SurveyOptionsController::class, 'index']);
Route::get('/option/{id}', [SurveyOptionsController::class, 'show']);
Route::get('/options/{id}', [SurveyOptionsController::class, 'showAllOptionsBySurvey']);
Route::get('/options-names/{id}', [SurveyOptionsController::class, 'showAllOptionsNameBySurvey']);

Route::post('/create-option/{id}', [SurveyOptionsController::class, 'create']);
Route::put('/survey/option/{id}', [SurveyOptionsController::class, 'update']);
Route::delete('/survey/option/{id}', [SurveyOptionsController::class, 'destroy']);

// Vote Route
Route::get('/votes', [VoteController::class, 'index']);
Route::get('/vote/{id}', [VoteController::class, 'show']);
Route::post('/vote/{id}', [VoteController::class, 'create']);
Route::put('/vote/{id}', [VoteController::class, 'update']);
Route::delete('/vote/{id}', [VoteController::class, 'delete']);
Route::get('/votes/{id}', [VoteController::class, 'getAllVotesFromOptions']);

