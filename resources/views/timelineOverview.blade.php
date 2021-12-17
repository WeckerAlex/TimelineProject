<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/timelineOverview.css') }}">
    <script>
        var verticalOffset = 0;
        var eventId = ""

        function openDetails(eventid) {
            document.getElementById("Detailspopup").style.display = "block";
            verticalOffset = window.pageYOffset || document.documentElement.scrollTop;
            eventId = eventid;
            window.scrollTo(0, 0);
            document.getElementById()
        }

        // Close the full screen search box
        function closeDetails() {
            document.getElementById("Detailspopup").style.display = "none";
            window.scrollTo(0, verticalOffset);
        }
    </script>
    <title>Timeline</title>
</head>

<body>
@php
    $check1 = DB::table('Language')->where('dtIso_code', $languageid)->count();
    $check2 = DB::table('CategoryLang')->where('dtText', $id)->where('fiLanguage', 1)->count();
    if ($check1 <> 1 or $check2 <> 1){
        echo "Problem";
        header("Location: ".route("home"));
        exit();
    }
    $langId = DB::table('Language')->where('dtIso_code', $languageid)->value('idLanguage');
    $catId = DB::table('CategoryLang')->where('dtText', $id)->where('fiLanguage', 1)->value('fiCategory');
    $categories = DB::table('CategoryLang')->where('fiLanguage', $langId)->pluck('dtText');
    $events = DB::table('EventCategory')
                        ->where('fiCategory', $catId)
                        ->leftJoin('Event', 'EventCategory.fiEvent', '=', 'Event.idEvent')
                        ->leftJoin('EventLang', 'EventCategory.fiEvent', '=', 'EventLang.fiEvent')
                        ->where('fiLanguage', $langId)
                        ->orderBy('dtYear', 'asc')
                        ->get();
    function test(){

    }
@endphp

    <header style="background-image: url({{url('images/intro_page/Image7_modif@2x.png')}})">
        <div>
            Share
        </div>
        <h1>{{
            DB::table('CategoryLang')->where('fiCategory', $catId)->where('fiLanguage', $langId)->value('dtText')
            }}</h1>
    </header>
    <div id="popup">
        <ul id="categoryList">
            @foreach($categories as $category)
                <li>{{$category}}</li>
                <br>
            @endforeach
        </ul>
        <div id = popupbutton>

        </div>
    </div>
    <div id="timeline">
        @foreach($events as $eventdata)
            <div id="card">
                <h2>{{$eventdata->dtYear}}</h2>
                <h3>{{$eventdata->dtTitle}}</h3>
                <p>{{$eventdata->dtDescription}}</p>
                <button onclick=openDetails({{$eventdata->idEvent}});>Details</button>
            </div>
        @endforeach
    </div>
    <div id="Detailspopup" class="overlay">
        <span class="closebtn" onclick=closeDetails()>Go back</span>
        <div class="overlay-content">
            @include('eventDetails',['eventid' => rand(1,10),'languageid' => $langId]);
        </div>
    </div>
</body>
</html>

