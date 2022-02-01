<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TimelineController extends Controller
{
    //
    private function getTimelineView($category,$languageid,$eventId){
        $check1 = DB::table('Language')->where('dtIso_code', $languageid)->count();
        $check2 = DB::table('CategoryLang')->where('dtText', $category)->where('fiLanguage', 1)->count();
        if ($check1 <> 1 or $check2 <> 1 or !is_numeric($eventId)){
            if ($check2 == 1 and is_numeric($eventId)){
                if ($eventId == null){
                    return redirect()->route("Timeline",['category'=> $category]);
                }else{
                    return redirect()->route("TimelinewithEvent",['category'=> $category,'eventId'=> $eventId]);
                }
            }else{
                return redirect()->route("home");
            }
        }else{
            //Language and Category do exist
            $langId = DB::table('Language')->where('dtIso_code', $languageid)->value('idLanguage');
            $catId = DB::table('CategoryLang')->where('dtText', $category)->where('fiLanguage', 1)->value('fiCategory');
            $categories = DB::table('CategoryLang')->where('fiLanguage', $langId)->pluck('fiCategory');
            $events = DB::table('EventCategory')
                ->where('fiCategory', $catId)
                ->leftJoin('Event', 'EventCategory.fiEvent', '=', 'Event.idEvent')
                ->leftJoin('EventLang', 'EventCategory.fiEvent', '=', 'EventLang.fiEvent')
                ->where('fiLanguage', $langId)
                ->orderBy('dtYear', 'asc')
                ->get();
            return view('timelineOverview',['catId'=> $catId, 'langId' => $langId, 'categories' => $categories,'events'=> $events,'languagetxt'=> $languageid,'categorytxt'=> $category,'eventId'=> $eventId]);
        }
    }

    public function getTimeline($category,$languageid = "fr"){
        return $this->getTimelineView($category,$languageid,null);
    }

    public function getTimelineWithEvent($category,$eventId,$languageId = "fr"){
        return $this->getTimelineView($category,$languageId,$eventId);
    }
}