<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TimelineController extends Controller
{
    //
    private function getTimelineView($category,$languageid,$eventId){
        $category = str_replace("_", " ", $category);
        $check1 = DB::table('Language')->where('dtIso_code', $languageid)->count();
        $check2 = DB::table('CategoryLang')->where('dtText', $category)->where('fiLanguage', 1)->count();
        if ($check1 <> 1 or $check2 <> 1 or !(is_numeric($eventId) or is_null($eventId) )){
            //language does not exit or category does not exist or event is NaN or null
            if ($check2 == 1){
                //language does not exit or event is NaN or null
                if (!is_numeric($eventId) or is_null($eventId)){
                    //event is NaN or null
                    return redirect()->route("Timeline",['category'=> $category]);
                }else{
                    //language does not exit
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
                ->orderBy('dtYear', 'desc')
                ->get();

            $imageLocation = DB::table('Media')->where('idMedia', DB::table('Category')->where('idCategory', $catId)->value('fiMedia'))->value('dtPath');
            //$imageLocation = str_replace(".", "@2x.", $imageLocation);
            return view('timelineOverview',['catId'=> $catId, 'langId' => $langId, 'categories' => $categories,'events'=> $events,'languagetxt'=> $languageid,'categorytxt'=> $category,'eventId'=> $eventId,'imagePath'=>$imageLocation]);
        }
    }

    public function getTimeline($category,$languageid = "FR"){
        return $this->getTimelineView($category,$languageid,null);
    }

    public function getTimelineWithEvent($category,$eventId,$languageId = "FR"){
        return $this->getTimelineView($category,$languageId,$eventId);
    }
}
