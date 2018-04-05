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
Route::get('/', function () {
	return View::make('auth.login');
});
*/

Route::get('/', function () {
    return view('welcome');
});

 // Route::get('/{user}/{venium}/{survey}/{month}/{end}/{status}','SurveyController@index');
 Route::get('/{data}/{status}','SurveyController@index');
 Route::post('/create_record','SurveyController@create');


Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
    Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);
  //Inventario
    Route::get('/detailed_hotel', 'HotelDController@index');
    //posts detailed_hotel
    Route::post('/detailed_hotel_head','HotelDController@getHeaders');
    Route::post('/detailed_hotel_sum','HotelDController@getSummary');
    Route::post('/detailed_hotel_sw','HotelDController@getSwitch');
    Route::post('/detailed_hotel_zd','HotelDController@getZone');
    Route::post('/detailed_hotel_pie','HotelDController@getSummaryPie');
    Route::post('/detailed_hotel_disqn','HotelDController@getDristributionQuantitys');
    Route::post('/detailed_hotel_models','HotelDController@getEquipmentModels');
    Route::post('/detailed_hotel_table','HotelDController@getDetailedEquipment');
    //**********//
    Route::get('/detailed_hotels', 'HotelCController@index');
    Route::get('/detailed_proyect', 'HotelPController@index');
    //posts detailed_proyect
    Route::post('detailed_pro_head', 'HotelPController@getHeaderProject');
    Route::post('detailed_pro_stat', 'HotelPController@getStatusProject');
    Route::post('detailed_pro_ap', 'HotelPController@getGraphAPS');
    Route::post('detailed_pro_sw', 'HotelPController@getGraphSWS');
    Route::post('detailed_pro_dispro', 'HotelPController@getDispProject');
    Route::post('detailed_pro_modpro', 'HotelPController@getModelProject');
    Route::post('detailed_pro_tab', 'HotelPController@getProjectTable');
    //**********//

    Route::get('/detailed_cover', 'CoverController@index');
    //posts detailed_proyect
    Route::post('/cover_header', 'CoverController@getHeader');
    Route::post('/cover_dist_equipos', 'CoverController@getCoverDistEquipos');
    Route::post('/cover_dist_modelos', 'CoverController@getCoverDistModelos');

    Route::post('/hotel_cadena', 'HotelDController@hotel_cadena');
    /*Distribution*/
    Route::get('/detailed_distribution', 'DistributionController@index');
    Route::post('/geoHotel', 'DistributionController@show');

  //- Equipos
    Route::get('/up_equipment', 'AddEquipmentController@index');
    Route::get('/down_equipment', 'RemovedEquipmentController@index');
    Route::get('/detailed_search', 'SearchEquipmentController@index');
    Route::get('/move_equipment', 'MoveEquipmentController@index');
    Route::get('/group_equipment', 'GroupEquipmentController@index');
    Route::get('/provider', 'ProviderController@index');
  //- Reportes
    Route::get('/type_report' , 'AssignTypeController@index');
    Route::post('/data_type_report' , 'AssignTypeController@show');
    Route::post('/show_edit_type_report' , 'AssignTypeController@edit');

    Route::get('/viewreports' , 'ViewReportsController@index');
    Route::post('/typereport','ViewReportsController@typerep');
    Route::post('/view_reports_header', 'ViewReportsController@report_header');
    Route::post('/get_client_wlan', 'ViewReportsController@graph_client_wlan');
    Route::post('/get_client_wlan_top', 'ViewReportsController@client_wlan_top');
    Route::post('/get_user_month', 'ViewReportsController@user_month');
    Route::post('/get_gb_month', 'ViewReportsController@gb_month');
    Route::post('/get_mostAP_top5', 'ViewReportsController@mostAP_top5');
    Route::post('/get_comparative', 'ViewReportsController@tab_comparativa');
  //Reporte concatenado
    Route::get('/viewreportscont', 'ViewReportContController@index');
    Route::post('/get_user_cont', 'ViewReportContController@table_user');
    Route::post('/get_gb_cont', 'ViewReportContController@table_gb');
    Route::post('/get_device_cont', 'ViewReportContController@table_device');
  //Calificaciones
    Route::get('/view_dashboard_survey_nps' , 'ViewDashNPSController@index');
    Route::get('/create_survey_admin' , 'CreateSurveyController@index');
    Route::post('create_survey_record', 'CreateSurveyController@create'); //Record survey
    Route::get('/fill_survey_admin' , 'CaptureSurveyController@index');
    Route::get('/edit_survey_admin' , 'EditSurveyController@index');
    Route::get('/survey_results' , 'ResultsSurveyController@index');
  //Post Survey_results.
    Route::post('/survey_viewresults' , 'ResultsSurveyController@result_survey');
    Route::post('/get_modal_comments' , 'ResultsSurveyController@comment_survey');
    Route::get('/configure_survey_admin' , 'ConfigurationSurveyController@index');
    Route::post('/assign_survey' , 'ConfigurationSurveyController@create');
  //Configuracion nps
    Route::get('/configure_survey_admin_nps' , 'ConfigurationSurveyController@index_nps');
    Route::post('/user_vertical' , 'ConfigurationSurveyController@show_nps');
    Route::post('/user_client' , 'ConfigurationSurveyController@show_client');
    Route::post('/data_create_client_config', 'ConfigurationSurveyController@create_client_nps');
    Route::post('/show_assign_surveyed', 'ConfigurationSurveyController@show_assign_client_nps');
    Route::post('/creat_assign_surveyed', 'ConfigurationSurveyController@creat_assign_client_ht');
    Route::post('/data_delete_client_config', 'ConfigurationSurveyController@delete_client_nps');
    Route::post('/delete_assign_surveyed', 'ConfigurationSurveyController@delete_assign_client_nps');
    Route::post('/create_data_client', 'ConfigurationSurveyController@capture_individual');
    Route::post('/create_data_auto_client', 'ConfigurationSurveyController@capture_auto');
    Route::post('/show_survey_table', 'ConfigurationSurveyController@user_surveys_table');

  //Dashboard nps
    Route::post('/summary_info_nps' , 'ViewDashNPSController@show_summary_info_nps');
    Route::post('/show_comparative_year' , 'ViewDashNPSController@compare_year');
    Route::post('/get_graph_nps' , 'ViewDashNPSController@percent_graph_nps');
    Route::post('/get_graph_ppd' , 'ViewDashNPSController@cant_graph_ppd');
    Route::post('/get_graph_uvsr' , 'ViewDashNPSController@graph_uvsr');
    Route::post('/get_graph_avgcal' , 'ViewDashNPSController@graph_avgcal');
    Route::post('/get_table_vert' , 'ViewDashNPSController@table_vert');


  //Dashboard Sitwifi
    Route::get('/view_dashboard_survey_sit' , 'ViewDashSitController@index');
    Route::get('/configure_survey_admin_sit' , 'ConfigurationSitController@index');
    Route::post('/get_data_survey_ys', 'ViewDashSitController@show_q');
    Route::post('/get_data_result_q', 'ViewDashSitController@show_result_q');
    Route::post('/get_data_result_q', 'ViewDashSitController@show_result_q');
    Route::post('/search_user_domain', 'ViewDashSitController@show_user');
    Route::post('/create_manual_survey_record', 'ViewDashSitController@survey_record');
    Route::post('/show_survey_table_sit', 'ViewDashSitController@user_surveys_sitwifi');

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

    Route::get('/acm1pt', 'ResultsSurveyController@test');
  //- individual
    Route::get('/individual', 'IndividualController@index');
    Route::post('/upload_client', 'IndividualController@upload_client');
    Route::post('/upload_banda', 'IndividualController@upload_banda');
  //- Editar individual
    Route::get('/edit_report', 'EditReportController@index');
  //- Aproval concierge
    Route::get('/approval', 'ApprovalConciergeController@index');
  //- Aproval admin
    Route::get('/approvals', 'ApprovalAdminController@index');

});
