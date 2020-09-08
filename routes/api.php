<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('recruitments', 'Client\RecruitmentController');
Route::get('getrecruitmentorder', 'Client\RecruitmentController@getRecruitmentOrder');
Route::get('getrecruitmentsbyemployerid/{id}', 'Client\RecruitmentController@getRecruitmentsByEmployerId');
Route::get('getrecruitmentsbyuserid/{id}', 'Client\RecruitmentController@getRecruitmentByUserId');


Route::resource('candidates', 'Client\CandidateController');
Route::get('getcandidateorder', 'Client\CandidateController@getCandidateOrder');


Route::resource('employers', 'Client\EmployerController');
Route::get('getemployerorder', 'Client\EmployerController@getEmployerOrder');


