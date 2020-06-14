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
    return redirect('/home');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/accounts', 'AccountController@index')->name('accounts.list')->middleware('verified');

Route::get('/manage/{accountID}', 'AccountController@manage')->name('accounts.manage')->middleware('verified');

Route::get('/manage/account/{accountID}/usage', 'AccountController@api_get_usage')->name('accounts.usage')->middleware('verified');

Route::get('/manage/domains/{accountID}', 'AccountController@domainIndex')->name('accounts.domains')->middleware('verified');
Route::get('/manage/domains/{accountID}/dkim', 'AccountController@dkimIndex')->name('accounts.domain.dkim')->middleware('verified');
Route::post('/manage/domains/{accountID}/dkim', 'AccountController@getDkim')->name('accounts.domain.dkim.get')->middleware('verified');
Route::get('/manage/domains/{accountID}/spf', 'AccountController@spfIndex')->name('accounts.domain.spf')->middleware('verified');
Route::post('/manage/domains/{accountID}/spf', 'AccountController@getSPF')->name('accounts.domain.spf.get')->middleware('verified');
Route::get('/manage/domains/{accountID}/pop', 'AccountController@popIndex')->name('accounts.domain.pop')->middleware('verified');
Route::post('/manage/domains/{accountID}/pop', 'AccountController@getPOP')->name('accounts.domain.pop.get')->middleware('verified');
Route::post('/manage/domains/{accountID}/pop/new', 'AccountController@createPOP')->name('accounts.domain.pop.new')->middleware('verified');
Route::post('/manage/domains/{accountID}/pop/delete', 'AccountController@deletePOP')->name('accounts.domain.pop.delete')->middleware('verified');
Route::post('/manage/domains/{accountID}/pop/reset', 'AccountController@resetPOP')->name('accounts.domain.pop.reset')->middleware('verified');

Route::post('/manage/domains/{accountID}/create', 'AccountController@domainCreate')->name('accounts.domain.create')->middleware('verified');
Route::post('/manage/domains/{accountID}/delete', 'AccountController@domainDelete')->name('accounts.domain.delete')->middleware('verified');
Route::post('/manage/{accountID}/sso', 'AccountController@email_sso')->name('accounts.sso')->middleware('verified');

Route::get('/misc/closetab', 'AccountController@finishSession')->name('misc.closetab')->middleware('verified');