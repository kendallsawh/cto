<?php

use Illuminate\Support\Facades\Route;
use App\Http\Contollers\RolesController;
use App\Http\Contollers\PermissionsController;
use App\Http\Controllers\Auth\CompanyRegistrationController;
use App\Http\Controllers\ProcessBuilderController;
use App\Http\Controllers\ProcessFlowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
     /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/mof-listing', 'HomeController@moflisting')->name('home.moflisting');
    Route::get('/dl', 'HomeController@download');
    Route::get('/del', 'HomeController@cleaner');
    Route::get('/organize/{activity}', 'PsipDocumentController@getGroupDocuments')->name('psipupload.organize');
    Route::post('/organize-save', 'PsipDocumentController@updateGroupDocuments')->name('psipupload.organizesave');

    Route::post('/subscribe', 'PushNotificationController@storeSubscription')->name('notification.subscribe');

    Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');


    Route::get('/dl2', 'HomeController@download2')->name('test');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        Route::get('/register/company', [CompanyRegistrationController::class, 'create'])
            ->name('company.register');
        Route::post('/register/company', [CompanyRegistrationController::class, 'store']);

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        //Route::post('/search', 'SearchController@searchresult')->name('searchform');
        Route::get('/search', 'SearchController@search')->name('search.autocomplete');
        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            // Show change password form
            Route::get('/password/change', 'PasswordResetController@showChangePasswordForm')->name('users.password.change')->middleware('auth');

            // Update password
            Route::post('/password/update', 'PasswordResetController@updatePassword')->name('users.password.update')->middleware('auth');

            });

        /**
         * Log Routes
         */
        Route::group(['prefix' => 'logs'], function() {

            Route::get('/logs', 'LogsController@index')->name('logs.index'); // All logs
            Route::get('/logs/deleted', 'LogsController@deleted')->name('logs.deleted'); // Deleted logs
            Route::get('/logs/updated', 'LogsController@updated')->name('logs.updated'); // Updated logs

            Route::post('/logs/restore-deleted/{logId}', 'LogsController@restoreDeleted')->name('logs.restore'); // Restore deleted record
            Route::post('/logs/restore-update/{logId}', 'LogsController@restoreUpdate')->name('logs.restore_update'); // Restore updated record

            //Route for Viewing Logs by User
            Route::get('/logs/user/{userId}', 'LogsController@logsByUser')->name('logs.user'); // Logs by user

            //Route for Searching by User Name
            Route::get('/logs/search', 'LogsController@searchLogs')->name('logs.search'); // Search logs by user name

        });
        /**
         * Posts Routes
         */
        Route::group(['prefix' => 'posts'], function() {
            Route::get('/', 'PostsController@index')->name('posts.index');
            Route::get('/create', 'PostsController@create')->name('posts.create');
            Route::post('/create', 'PostsController@store')->name('posts.store');
            Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
            Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
            Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
            Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
        });

        Route::group(['prefix' => 'psipupload'],function(){
            //Route::get('/{psip}/adddoc', 'PsipDocumentController@create')->name('psipupload.create');
            Route::post('/{activity}/psip_upload', 'PsipDocumentController@store')->name('psipupload.store');

            Route::get('/{psip}/edit', 'PsipDocumentController@edit')->name('psipupload.edit');
            Route::patch('/{psip}/update', 'PsipDocumentController@update')->name('psipupload.update');

            Route::get('/create/{activity}', 'PsipDocumentController@create')->name('psipupload.create');
            Route::post('/document/update/', 'PsipDocumentController@update')->name('psipdocument.update');
            Route::post('/document/updatedetails', 'PsipDocumentController@updatedetails')->name('psipdocument.updatedetails');

            Route::get('/get-psips/{division}', 'PsipDocumentController@getPsips')->name('get.psips');
            Route::get('/get-activities/{psip}', 'PsipDocumentController@getActivities')->name('get.activities');
            Route::post('/screening-brief/{psip}', 'PsipDocumentController@addScreeningBrief')->name('psipupload.addscreeningbrief');
            Route::post('/achievement-report/{psip}', 'PsipDocumentController@addAchievementReport')->name('psipupload.achievementreport');//new route to add to permissions
            Route::post('/ps-note/{psip}', 'PsipDocumentController@addPSNote')->name('psipupload.addpsnote');//new route to add to permissions



            //Route::get('/show', 'PsipDocumentController@show')->name('psipupload.show');
        });

        Route::group(['prefix' => 'assign'],function(){
            Route::get('/document', 'PsipDocumentController@assign')->name('assign.create');
            Route::post('/document/store', 'PsipDocumentController@store_assign')->name('assign.store');

            /*ajax*/
            Route::get('/get-psips/{division}', 'PsipDocumentController@getPsips')->name('get.psips');
            Route::get('/get-activities/{psip}', 'PsipDocumentController@getActivities')->name('get.activities');
            Route::post('/searchDocTypeDivision', 'PsipDocumentController@searchDocTypeDivision')->name('activities.filltable');
        });

        Route::group(['prefix' => 'psip'],function(){
            Route::get('/{division}/index', 'PsipController@index')->name('psip.index');
            Route::get('/{psip}/show', 'PsipController@show')->name('psip.show');
            Route::get('/previous-years', 'PsipController@prev_yrs')->name('psip.prev_yrs');
            Route::get('/add', 'PsipController@create')->name('psip.create');
            Route::post('/store', 'PsipController@store')->name('psip.store');
            Route::get('/{id}/edit', 'PsipController@edit')->name('psip.edit');
            Route::put('/{id}', 'PsipController@update')->name('psip.update');
            Route::post('/approved-estimate/{psip}', 'PsipController@updateApproved')->name('psip.updatedapproveest');
            Route::post('/revised-estimate/{psip}', 'PsipController@updateRevised')->name('psip.updaterevisedest');
            Route::get('/{psipname}/projection', 'PsipProjectionController@create')->name('psip.projection');
            Route::post('/projection/{psipname}', 'PsipProjectionController@store')->name('psip.store_projection');
            Route::post('/current-expenditure/{psip}', 'PsipController@updateCurrentExpenditure')->name('psip.updatecurrexp');
            Route::post('/surpress-psip/{psip}', 'PsipController@surpressPsip')->name('psip.cancelpsip');
            Route::post('/psip-detail-edit/{psip}', 'PsipController@updatePsipDetail')->name('psip.editpsipdetails');//new route to add to permissions



            Route::post('/psip-pastupdateRevEst','PsipController@EditPastRevisedEstimate')->name('psip.updatepastRevEst');
            Route::post('/psip-pastaddRevEst','PsipController@AddPastRevisedEstimate')->name('psip.addpastRevEst');

            Route::post('/psip-pastupdateEst','PsipController@EditPastEstimate')->name('psip.updatepastEst');
            Route::post('/psip-pastaddEst','PsipController@AddPastEstimate')->name('psip.addpastEst');

            Route::post('/psip-pastupdateAct','PsipController@EditPastActual')->name('psip.updatepastAct');
            Route::post('/psip-pastaddAct','PsipController@AddPastActual')->name('psip.addpastAct');
        });

        Route::group(['prefix' => 'division'],function(){
            Route::get('/add', 'DivisionController@create')->name('division.create');
            Route::post('/store', 'DivisionController@store')->name('division.store');
            Route::get('/{id}/edit', 'DivisionController@edit')->name('division.edit');
            Route::patch('/{id}/update', 'DivisionController@update')->name('division.update');
        });


        Route::group(['prefix' => 'doctype'],function(){
            Route::get('/add/{activity}', 'PsipDocumentController@showdoctype')->name('doctype.create');
            Route::post('/addtolist', 'PsipDocumentController@adddoctype')->name('doctype.add.to.database');
        });


        Route::group(['prefix' => 'activity'],function(){


            Route::get('/add', 'ActivityController@create')->name('activities.create');
            Route::post('/store', 'ActivityController@store')->name('activities.store');
            Route::get('/activity-edit/{psip}', 'ActivityController@edit')->name('activities.edit');//new route to add to permissions
            Route::post('/activity-update/{psip}', 'ActivityController@update')->name('activities.update');//new route to add to permissions
            Route::post('/surpress-activity', 'ActivityController@surpressActivity')->name('activities.surpressactivity');
            Route::post('/cancel-activity', 'ActivityController@softDelete')->name('activities.removeactivity');

        });

        Route::group(['prefix' => 'activity-photo'],function(){

            Route::get('image-gallery/{id}', 'ActivityPhotoController@index')->name('activityphoto.index');
            Route::post('image-gallery/{id}', 'ActivityPhotoController@upload')->name('activityphoto.upload');
            Route::delete('image-gallery/{id}', 'ActivityPhotoController@destroy')->name('activityphoto.destroy');

        });

        Route::group(['prefix' => 'activity-particulars'], function () {
            Route::put('/update','ActivityParticularController@update')->name('activity_particulars.update');
        });


        // admin routes
        Route::get('/update_financial', 'OptionsController@update_psip')->name('update.psip.financials');
        Route::post('/update_financial', 'OptionsController@update_psip_store')->name('update.psip.financials.store');
        Route::get('/add-document-to-list', 'OptionsController@createDocument')->name('add.document.page.create');
        Route::post('/add-document-to-list', 'OptionsController@addDocument')->name('add.document.to.database.store');
        Route::get('/start-process', 'PsipController@startProcess')->name('update.all.psip');
        Route::get('/dataentry/{id}', 'DataEntryController@create')->name('dataentry.create');
        Route::post('/start_dataentry/{psip}', 'DataEntryController@store')->name('dataentry.store');

        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');

        // ----------------------------------------------------------------
        // New Admin Routes for Tutorial Management & Progress Reset
        // ----------------------------------------------------------------
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            // Route to show the reset progress page
            Route::get('tutorials/reset-progress', 'TutorialController@showResetProgressForm')
                ->name('tutorials.resetProgressPage');

            // Route to process the reset progress action
            Route::post('tutorials/reset-progress', 'TutorialController@resetProgress')
                ->name('tutorials.resetProgress');
            // CRUD routes for tutorials
            Route::resource('tutorials', 'TutorialController');


        });
    });
    // Tutorial routes
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/tutorial/{tutorialName}', [\App\Http\Controllers\TutorialController::class, 'getTutorialSteps'])
            ->name('tutorial.getSteps');
        Route::post('/mark-tutorial-complete', [\App\Http\Controllers\TutorialController::class, 'markTutorialComplete'])
            ->name('tutorial.markComplete');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/activities/{id}/add-particular-modal', [\App\Http\Controllers\PsipController::class, 'addParticularModal'])
            ->name('activities.add_particular_modal');

        Route::post('/activities/{id}/store-particulars', [\App\Http\Controllers\PsipController::class, 'storeParticulars'])
            ->name('activities.store_particulars');
    });


    // ----------------------------------------------------------------
    // New Admin and Planning Roles Routes for Process Flow Management
    // ----------------------------------------------------------------
    Route::middleware(['auth', 'permission'])->prefix('process-builder')->name('process_builder.')->group(function () {
        Route::get('/', [ProcessBuilderController::class, 'index'])->name('index');
        Route::get('/create', [ProcessBuilderController::class, 'create'])->name('create');
        Route::post('/', [ProcessBuilderController::class, 'store'])->name('store');
        Route::get('/{flow}/edit', [ProcessBuilderController::class, 'edit'])->name('edit');
        Route::put('/{flow}', [ProcessBuilderController::class, 'update'])->name('update');
        Route::delete('/{flow}', [ProcessBuilderController::class, 'destroy'])->name('destroy');

        // Steps
        Route::get('/{flow}/steps/create', [ProcessBuilderController::class, 'createStep'])->name('steps.create');
        Route::post('/{flow}/steps', [ProcessBuilderController::class, 'storeStep'])->name('steps.store');
        Route::get('/steps/{step}/edit', [ProcessBuilderController::class, 'editStep'])->name('steps.edit');
        Route::put('/steps/{step}', [ProcessBuilderController::class, 'updateStep'])->name('steps.update');
        Route::delete('/steps/{step}', [ProcessBuilderController::class, 'destroyStep'])->name('steps.destroy');

        //manual step advance
        Route::post('/advance/{instance}', [ProcessFlowController::class, 'advance'])->name('process.advance');

        // Optional: AJAX reorder
        Route::post('/{flow}/steps/reorder', [ProcessBuilderController::class, 'reorderSteps'])->name('steps.reorder');
    });




});
