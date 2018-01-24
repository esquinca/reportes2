<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
    Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);
  //Inventario
    Route::get('/detailed_hotel', 'HotelDController@index');
    Route::get('/detailed_hotels', 'HotelCController@index');
    Route::get('/detailed_proyect', 'HotelPController@index');
    Route::get('/detailed_cover', 'CoverController@index');
    Route::get('/detailed_distribution', 'DistributionController@index');
  //- Equipos
    Route::get('/up_equipment', 'AddEquipmentController@index');
    Route::get('/down_equipment', 'RemovedEquipmentController@index');
    Route::get('/detailed_search', 'SearchEquipmentController@index');
    Route::get('/move_equipment', 'MoveEquipmentController@index');
    Route::get('/group_equipment', 'GroupEquipmentController@index');
  //- Reportes
    Route::get('/viewreports' , 'ViewReportsController@index');
    Route::post('/typereport','ViewReportsController@typerep');
  //Calificaciones
    Route::get('/create_survey_admin' , 'CreateSurveyController@index');
    Route::get('/fill_survey_admin' , 'CaptureSurveyController@index');
    Route::get('/edit_survey_admin' , 'EditSurveyController@index');
    Route::get('/survey_results' , 'ResultsSurveyController@index');
    Route::get('/configure_survey_admin' , 'ConfigurationSurveyController@index');
  //- Herramientas
    Route::get('/detailed_guest_review', 'GuestToolsController@index');
    Route::get('/detailed_server_review', 'ServerToolsController@index');
    Route::get('/testzone', 'ZoneToolsController@index');

    Route::get('/DiagHuespedAjax','GuestToolsController@checkGuest');
    Route::get('/DiagHuespedAjax2', 'GuestToolsController@checkWebSer');

    Route::get('/DiagServidorAjax', 'ServerToolsController@checkRad');
    Route::get('/DiagServidorAjax2','ServerToolsController@checkWB');

  //- Perfil
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/data_config', 'ProfileController@show');
    Route::post('/profile_up', 'ProfileController@update');
    Route::post('/profile_up_pass', 'ProfileController@updatepass');

  //- Configuración
    Route::get('/Configuration', 'ConfigurationController@index')->name('Configuration');
    Route::post('/data_edit_config', 'ConfigurationController@store');
    Route::post('/data_menu_config', 'ConfigurationController@showMenu');
    Route::post('/data_create_user_config', 'ConfigurationController@create');
    Route::post('/data_edit_user_config', 'ConfigurationController@edit');

    Route::post('/data_edit_priv_config', 'ConfigurationController@update_priv');
    Route::post('/data_edit_menu_config', 'ConfigurationController@update_menu');
    Route::post('/data_delete_config', 'ConfigurationController@destroy');

});
