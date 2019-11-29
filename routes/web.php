<?php

use Illuminate\Http\Request;
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


/*
 * Auth routes.
 */
Auth::routes();
Route::redirect('/register', '/login');

/*
 * Home routes
 */
Route::view('/', 'welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');


/*
 * Search page routes
 */
Route::namespace('Search')->prefix('search')->middleware([ 'preventBackHistory' ])->group(function() {
    /**
     * Search Dashboard routes
     */
    Route::get('/', 'SearchController@dashboard')->name('search.dashboard')->middleware('searchpage');

    /**
     * Search ajax routes
     */
    Route::get('/initial', 'SearchController@initial')->name('search.initial');
    Route::post('/searching', 'SearchController@searching')->name('search.searching');
    Route::post('/presearch', 'SearchController@preSearch')->name('search.presearch');
    Route::post('/export', 'SearchController@export')->name('search.export');
    Route::get('/linkaction', 'SearchController@linkaction')->name('search.linkactionlog');

    /**
     * Save Search Criterias ajax routes
     */
    Route::get('/criterias', 'CriteriaController@showAll')->name('criterias.show.all');
    Route::post('/criterias', 'CriteriaController@save')->name('criterias.save');
    Route::patch('/criterias', 'CriteriaController@update')->name('criterias.update');
    Route::delete('/criterias', 'CriteriaController@delete')->name('criterias.delete');

    /**
     * Save Project ajax routes
     */
    Route::get('/projects', 'ProjectController@showAll')->name('projects.show.all');
    Route::post('/projects', 'ProjectController@save')->name('projects.save');
    Route::patch('/projects', 'ProjectController@update')->name('projects.update');
    Route::delete('/projects', 'ProjectController@delete')->name('projects.delete');
    Route::get('/projects/open', 'ProjectController@open')->name('projects.open');
    Route::get('/projects/export', 'ProjectController@export')->name('projects.export');

    /**
     * report routes
     */
    Route::post('/report', 'ReportController@report')->name('report');

});

/*
 * Admin routes
 */
Route::namespace('Admin')->prefix('admin')->middleware([ 'admin', 'preventBackHistory' ])->group(function() {
    /**
     * Dashboard routes
     */
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

    /**
     * Users routes
     */
    Route::get('/users', 'UserController@index')->name('admin.users.index');
    Route::get('/users/create', 'UserController@create')->name('admin.users.create');
    Route::post('/users', 'UserController@store')->name('admin.users.store');
    Route::get('/users/{id}/edit', 'UserController@edit')->name('admin.users.edit');
    Route::patch('/users/{user}', 'UserController@update')->name('admin.users.update');
    Route::delete('/users/{id}/delete', 'UserController@destroy')->name('admin.users.destroy');

    /**
     * Companies routes
     */
    Route::get('/companies', 'CompanyController@index')->name('admin.companies.index');
    Route::get('/companies/create', 'CompanyController@create')->name('admin.companies.create');
    Route::post('/companies', 'CompanyController@store')->name('admin.companies.store');
    Route::get('/companies/{id}/edit', 'CompanyController@edit')->name('admin.companies.edit');
    Route::patch('/companies/{company}', 'CompanyController@update')->name('admin.companies.update');
    Route::delete('/companies/{id}/delete', 'CompanyController@destroy')->name('admin.companies.destroy');

    /**
     * Roles routes
     */
    Route::get('/roles', 'RoleController@index')->name('admin.roles.index');
    Route::get('/roles/create', 'RoleController@create')->name('admin.roles.create');
    Route::post('/roles', 'RoleController@store')->name('admin.roles.store');
    Route::get('/roles/{id}/edit', 'RoleController@edit')->name('admin.roles.edit');
    Route::patch('/roles/{role}', 'RoleController@update')->name('admin.roles.update');
    Route::delete('/roles/{id}/delete', 'RoleController@destroy')->name('admin.roles.destroy');

    /**
     * Countries routes
     */
    Route::get('/countries', 'CountryController@index')->name('admin.countries.index');
    Route::get('/countries/create', 'CountryController@create')->name('admin.countries.create');
    Route::post('/countries', 'CountryController@store')->name('admin.countries.store');
    Route::get('/countries/{id}/edit', 'CountryController@edit')->name('admin.countries.edit');
    Route::patch('/countries/{country}', 'CountryController@update')->name('admin.countries.update');
    Route::delete('/countries/{id}/delete', 'CountryController@destroy')->name('admin.countries.destroy');

    /**
     * Regions routes
     */
    Route::get('/regions', 'RegionController@index')->name('admin.regions.index');
    Route::get('/regions/create', 'RegionController@create')->name('admin.regions.create');
    Route::post('/regions', 'RegionController@store')->name('admin.regions.store');
    Route::get('/regions/{id}/edit', 'RegionController@edit')->name('admin.regions.edit');
    Route::patch('/regions/{region}', 'RegionController@update')->name('admin.regions.update');
    Route::delete('/regions/{id}/delete', 'RegionController@destroy')->name('admin.regions.destroy');

    Route::get('/regions/get', 'RegionController@getRegionsAjax')->name('admin.regions.ajax.get');

    /**
     * Cities routes
     */
    Route::get('/cities', 'CityController@index')->name('admin.cities.index');
    Route::get('/cities/create', 'CityController@create')->name('admin.cities.create');
    Route::post('/cities', 'CityController@store')->name('admin.cities.store');
    Route::get('/cities/{id}/edit', 'CityController@edit')->name('admin.cities.edit');
    Route::patch('/cities/{city}', 'CityController@update')->name('admin.cities.update');
    Route::delete('/cities/{id}/delete', 'CityController@destroy')->name('admin.cities.destroy');

    Route::get('/cities/get', 'CityController@getCitiesAjax')->name('admin.cities.ajax.get');

    /**
     * Filter Practice areas routes
     */
    Route::get('/practices', 'PracticeAreaController@index')->name('admin.practices.index');
    Route::get('/practices/create', 'PracticeAreaController@create')->name('admin.practices.create');
    Route::post('/practices', 'PracticeAreaController@store')->name('admin.practices.store');
    Route::get('/practices/{id}/edit', 'PracticeAreaController@edit')->name('admin.practices.edit');
    Route::patch('/practices/{practice_area}', 'PracticeAreaController@update')->name('admin.practices.update');
    Route::delete('/practices/{id}/delete', 'PracticeAreaController@destroy')->name('admin.practices.destroy');

    /**
     * Filter Specialisms routes
     */
    Route::get('/specialisms', 'SpecialismController@index')->name('admin.specialisms.index');
    Route::get('/specialisms/create', 'SpecialismController@create')->name('admin.specialisms.create');
    Route::post('/specialisms', 'SpecialismController@store')->name('admin.specialisms.store');
    Route::get('/specialisms/{id}/edit', 'SpecialismController@edit')->name('admin.specialisms.edit');
    Route::patch('/specialisms/{specialism}', 'SpecialismController@update')->name('admin.specialisms.update');
    Route::delete('/specialisms/{id}/delete', 'SpecialismController@destroy')->name('admin.specialisms.destroy');

    Route::get('/specialisms/get', 'SpecialismController@getSpecialismsAjax')->name('admin.specialisms.ajax.get');

    /**
     * Filter SubSpecialisms routes
     */
    Route::get('/subs/', 'SubSpecialismController@index')->name('admin.subs.index');
    Route::get('/subs/create', 'SubSpecialismController@create')->name('admin.subs.create');
    Route::post('/subs', 'SubSpecialismController@store')->name('admin.subs.store');
    Route::get('/subs/{id}/edit', 'SubSpecialismController@edit')->name('admin.subs.edit');
    Route::patch('/subs/{sub}', 'SubSpecialismController@update')->name('admin.subs.update');
    Route::delete('/subs/{id}/delete', 'SubSpecialismController@destroy')->name('admin.subs.destroy');

    Route::get('/subs/get', 'SubSpecialismController@getSubSpecialismAjax')->name('admin.subs.ajax.get');

    /**
     * Filter Type&Rankings routes
     */
    Route::get('/types/', 'TypesRankingsController@index')->name('admin.types.index');
    Route::get('/types/create', 'TypesRankingsController@create')->name('admin.types.create');
    Route::post('/types', 'TypesRankingsController@store')->name('admin.types.store');
    Route::get('/types/{id}/edit', 'TypesRankingsController@edit')->name('admin.types.edit');
    Route::patch('/types/{type}', 'TypesRankingsController@update')->name('admin.types.update');
    Route::delete('/types/{id}/delete', 'TypesRankingsController@destroy')->name('admin.types.destroy');

    /**
     * Filter PQE Levels routes
     */
    Route::get('/pqes/', 'PQEController@index')->name('admin.pqes.index');
    //Route::get('/pqes/create', 'PQEController@create')->name('admin.pqes.create');
    //Route::post('/pqes', 'PQEController@store')->name('admin.pqes.store');
    Route::get('/pqes/{id}/edit', 'PQEController@edit')->name('admin.pqes.edit');
    Route::patch('/pqes/{pqe}', 'PQEController@update')->name('admin.pqes.update');
    Route::delete('/pqes/{id}/delete', 'PQEController@destroy')->name('admin.pqes.destroy');

    /**
     * Firms routes
     */
    Route::get('/firms/', 'FirmController@index')->name('admin.firms.index');
    Route::get('/firms/create', 'FirmController@create')->name('admin.firms.create');
    Route::post('/firms', 'FirmController@store')->name('admin.firms.store');
    Route::get('/firms/{id}/edit', 'FirmController@edit')->name('admin.firms.edit');
    Route::patch('/firms/{firm}', 'FirmController@update')->name('admin.firms.update');
    Route::delete('/firms/{id}/delete', 'FirmController@destroy')->name('admin.firms.destroy');

    /**
     * Firm locations routes
     */
    Route::get('/firms/{firm}/locations', 'FirmLocationController@index')->name('admin.firms.locations.index');
    Route::get('/firms/{firm}/locations/create', 'FirmLocationController@create')->name('admin.firms.locations.create');
    Route::post('/firms/{firm}/locations', 'FirmLocationController@store')->name('admin.firms.locations.store');
    Route::get('/firms/{firm}/locations/{id}/edit', 'FirmLocationController@edit')->name('admin.firms.locations.edit');
    Route::patch('/firms/{firm}/locations/{location}', 'FirmLocationController@update')->name('admin.firms.locations.update');
    Route::delete('/firms/{firm}/locations/{id}/delete', 'FirmLocationController@destroy')->name('admin.firms.locations.destroy');

    /**
     * Firm salaries routes
     */
    Route::get('/firms/{firm}/salaries', 'FirmSalaryController@index')->name('admin.firms.salaries.index');
    Route::get('/firms/{firm}/salaries/create', 'FirmSalaryController@create')->name('admin.firms.salaries.create');
    Route::post('/firms/{firm}/salaries', 'FirmSalaryController@store')->name('admin.firms.salaries.store');
    Route::get('/firms/{firm}/salaries/{id}/edit', 'FirmSalaryController@edit')->name('admin.firms.salaries.edit');
    Route::patch('/firms/{firm}/salaries/{salary}', 'FirmSalaryController@update')->name('admin.firms.salaries.update');
    Route::delete('/firms/{firm}/salaries/{id}/delete', 'FirmSalaryController@destroy')->name('admin.firms.salaries.destroy');

    /**
     * Candidates routes
     */
    Route::get('/candidates/', 'CandidateController@index')->name('admin.candidates.index');
    Route::get('/candidates/create', 'CandidateController@create')->name('admin.candidates.create');
    Route::post('/candidates', 'CandidateController@store')->name('admin.candidates.store');
    Route::get('/candidates/{id}/edit', 'CandidateController@edit')->name('admin.candidates.edit');
    Route::patch('/candidates/{candidate}', 'CandidateController@update')->name('admin.candidates.update');
    Route::delete('/candidates/{id}/delete', 'CandidateController@destroy')->name('admin.candidates.destroy');

    /**
     * Candidates locations routes
     */
    Route::get('/candidates/{candidate}/locations', 'CandidateLocationController@index')->name('admin.candidates.locations.index');
    Route::get('/candidates/{candidate}/locations/create', 'CandidateLocationController@create')->name('admin.candidates.locations.create');
    Route::post('/candidates/{candidate}/locations', 'CandidateLocationController@store')->name('admin.candidates.locations.store');
    Route::get('/candidates/{candidate}/locations/{id}/edit', 'CandidateLocationController@edit')->name('admin.candidates.locations.edit');
    Route::patch('/candidates/{candidate}/locations/{location}', 'CandidateLocationController@update')->name('admin.candidates.locations.update');
    Route::delete('/candidates/{candidate}/locations/{id}/delete', 'CandidateLocationController@destroy')->name('admin.candidates.locations.destroy');

    Route::get('/candidates/regions/get', 'CandidateLocationController@getRegionsAjax')->name('admin.candidates.regions.ajax.get');
    Route::get('/candidates/cities/get', 'CandidateLocationController@getCitiesAjax')->name('admin.candidates.cities.ajax.get');
    Route::get('/candidates/firms/locations/get', 'CandidateLocationController@getLocationAjax')->name('admin.candidates.firms.locations.ajax.get');

    /**
     * Candidates specialisms routes
     */
    Route::get('/candidates/{candidate}/specialisms', 'CandidateSpecialismController@index')->name('admin.candidates.specialisms.index');
    Route::get('/candidates/{candidate}/specialisms/create', 'CandidateSpecialismController@create')->name('admin.candidates.specialisms.create');
    Route::post('/candidates/{candidate}/specialisms', 'CandidateSpecialismController@store')->name('admin.candidates.specialisms.store');
    Route::get('/candidates/{candidate}/specialisms/{id}/edit', 'CandidateSpecialismController@edit')->name('admin.candidates.specialisms.edit');
    Route::patch('/candidates/{candidate}/specialisms/{subspecialism}', 'CandidateSpecialismController@update')->name('admin.candidates.specialisms.update');
    Route::delete('/candidates/{candidate}/specialisms/{id}/delete', 'CandidateSpecialismController@destroy')->name('admin.candidates.specialisms.destroy');

    /**
     * Export tools
     */
    Route::get('/tools/', 'ToolsController@index')->name('admin.tools.index');
    Route::post('/tools/import/candidates', 'ToolsController@importCandidates')->name('admin.import.candidates');

    /**
     * Reports routes
     */
    Route::get('/reports/', 'ReportController@index')->name('admin.reports.index');
    Route::get('/reports/{id}/edit', 'ReportController@edit')->name('admin.reports.edit');
    Route::patch('/reports/{report}', 'ReportController@update')->name('admin.reports.update');
    Route::delete('/reports/{id}/delete', 'ReportController@destroy')->name('admin.reports.destroy');

    Route::get('/activity_logs/', 'ActivityLogController@index')->name('admin.activitylog.index');
    Route::post('/activity_logs/export', 'ActivityLogController@export')->name('admin.activitylog.export');
});
