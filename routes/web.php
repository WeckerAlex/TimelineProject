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

Route::get('/Timeline/{languageId?}', function ($languageid = "fr") {
    return view('timeline',['languageid' => $languageid]);
})->name('home')->where('languageId', '[a-zA-Z-]{2}');

Route::get('/Timeline/{category}/{languageid?}', function ($category, $languageid = "fr") {
    return view('timelineOverview',['id'=> $category, 'languageid' => $languageid]);
});

//Route to specific category and event
Route::get('/Timeline/{category}/Event/{eventId}/{languageId?}', function ($category, $eventId = null, $languageid = "fr") {
    return view('timelineOverview',['id'=> $category,'eventId' => $eventId, 'languageid' => $languageid]);
});

Route::get('/Timeline/Event/{eventId}/{languageId}', function ($eventId, $languageid) {
    return view('eventDetails',['eventid' => $eventId,'languageid' => $languageid]);
});