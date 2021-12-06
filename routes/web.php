<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/Timeline', function () {
    return view('timeline');
});

//Route to specific category and event
Route::get('/Timeline/{category}/{eventId?}', function ($category, $eventId = null) {
    return view('timelineOverview',['id'=> $category,'eventId' => $eventId]);
});
