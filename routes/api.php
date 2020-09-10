<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
// add any additional headers you need to support here
header('Access-Control-Allow-Headers: Origin, Content-Type,X-Requested-With,Authorization');

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

Route::post('login', 'Client\AuthController@login');
Route::post('registerCandidate', 'Client\CandidateController@addCandidate');
Route::post('registerEmployer', 'Client\EmployerController@addEmployer');


Route::group(['middleware' => ['auth:api', 'scope:employer,candidate,admin']], function () {
    Route::post('user', 'Client\AuthController@user');
    Route::post('logout', 'Client\AuthController@logout');
});

Route::resource('recruitments', 'Client\RecruitmentController');
Route::get('getrecruitmentorder', 'Client\RecruitmentController@getRecruitmentOrder');
Route::get('getrecruitmentsbyemployerid/{id}', 'Client\RecruitmentController@getRecruitmentsByEmployerId');
Route::get('getrecruitmentsbyuserid/{id}', 'Client\RecruitmentController@getRecruitmentByUserId');
Route::get('getcandidatesbyuserid/{id}', 'Client\RecruitmentController@getCandidateByUserId');


Route::resource('candidates', 'Client\CandidateController');
Route::get('getcandidateorder', 'Client\CandidateController@getCandidateOrder');
Route::get('getinfocandidatebyuserid/{id}', 'Client\CandidateController@getCandidateByUserId');
Route::get('getrecruitmentapplybyuserid/{id}', 'Client\CandidateController@getRecruitmentByUserId');


Route::resource('employers', 'Client\EmployerController');
Route::get('getemployerorder', 'Client\EmployerController@getEmployerOrder');
Route::get('getinfoemployerbyuserid/{id}', 'Client\EmployerController@getEmployerByUserId');
Route::get('getcandidatesavesbyuserid/{id}', 'Client\EmployerController@getCandidateSaveByUserId');

Route::resource('ranks', 'Client\RankController');
Route::resource('cities', 'Client\CityController');
Route::resource('careers', 'Client\CareerController');
Route::resource('salaries', 'Client\SalaryController');
Route::resource('typeofworks', 'Client\TypeOfWorkController');




