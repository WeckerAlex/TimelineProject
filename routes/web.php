<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimelineController;

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
    return redirect('/Timeline');
});

Route::get('/Timeline/{languageId?}', function ($languageid = "fr") {
    return view('timeline',['languageid' => $languageid]);
})->name('home')->where('languageId', '[a-zA-Z-]{2}');




//Route::get('/Timeline/{category}/{languageid?}', function ($category, $languageid = "fr") {
//    return view('timelineOverview',['id'=> $category, 'languageid' => $languageid]);
//})->name('Timeline');

Route::get('/Timeline/{category}/{languageid?}', [TimelineController::class, 'getTimeline'])->name('Timeline');

//Route to specific category and event
//Route::get('/Timeline/{category}/Event/{eventId}/{languageId?}', function ($category, $eventId = null, $languageid = "fr") {
//    return view('timelineOverview',['id'=> $category,'eventId' => $eventId, 'languageid' => $languageid]);
//});

Route::get('/Timeline/{category}/Event/{eventId}/{languageId?}', [TimelineController::class, 'getTimelineWithEvent'])->name('TimelinewithEvent');




//Details popover Content
Route::get('/Timeline/Event/{eventId}/{languageId}', function ($eventId, $languageid) {
    return view('eventDetails',['eventid' => $eventId,'languageid' => $languageid]);
})->name('Details');
