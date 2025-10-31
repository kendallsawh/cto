<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;

Route::middleware('auth')->group(function () {
    Route::get('/tutorial/{tutorialName}', [TutorialController::class, 'getTutorialSteps']);
    Route::post('/mark-tutorial-complete', [TutorialController::class, 'markTutorialComplete']);
});


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::post('subscribe', 'PushNotificationController@storeSubscription');
});
*/
