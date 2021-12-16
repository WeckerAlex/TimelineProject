<?php



$event = DB::table('EventLang')->where('fiLanguage', $languageid)->where('fiEvent', $eventid)->get();



//$titles = DB::table('EventLang')->where('fiLanguage', $languageid)->where('fiEvent', $eventid)->pluck('dtTitle');


foreach ($event as $singleEvent) {
    echo "<h1>".$singleEvent->dtTitle."</h1>";
    echo "<h7>".$singleEvent->dtDescription."</h7>";
    echo "<p>".$singleEvent->dtContent."</p>";
}

?>