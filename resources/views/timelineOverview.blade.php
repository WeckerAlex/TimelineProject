<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/timelineOverview.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/colors.css') }}">
    <script>
        var verticalOffset = 0;
        var isMenuShown = false;

        function openDetails(eventid) {
            document.getElementById("Detailspopup").style.display = "block";
            document.body.style.overflow = "hidden";
            verticalOffset = window.pageYOffset || document.documentElement.scrollTop;
            window.scrollTo(0, 0);
            {{--document.getElementById("overlay").innerHTML = <?php @include('eventDetails',['eventid' => rand(1,10),'languageid' => 1])?>;--}}
        }

        // Close the full screen search box
        function closeDetails() {
            document.getElementById("Detailspopup").style.display = "none";
            document.body.style.overflow = "scroll";
            window.scrollTo(0, verticalOffset);
        }

        function togglemenu(){
            console.log("menu Toggle");
        }
        function copyToClipboard(){
            console.log("Copied the text");
            var currenturl = window.location
            console.log("Copied the text: " + currenturl);
            navigator.clipboard.writeText(currenturl);
            alert("Copied the text: " + currenturl);
        }
    </script>
    <script>
        function init() {
            drawTimeline();
        }
        function drawTimeline(){
            console.log("Drawing");
            var canvas = document.getElementById("lineCanvas");
            var timelineArea = document.getElementById("timeline");
            canvas.style.height = timelineArea.scrollHeight+"px";
            canvas.height = timelineArea.scrollHeight;
            canvas.width = window.innerWidth;

            var ctx = canvas.getContext("2d");
            var width = canvas.width;
            var height = canvas.height;
            var middle = width/2;
            var segmentcount = document.getElementsByClassName("card").length/4;
            var segmentlength = height/segmentcount;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.lineWidth = 10;
            ctx.strokeStyle = 'red';

            //draw timeline
            ctx.beginPath();
            ctx.moveTo(middle, 0);//move cursor to top middle
            var offset = 0;
            var edge;
            for (let i = 0; i<segmentcount; i++){
                offset = i * segmentlength;
                edge = ((i % 2) ? 0 : width);
                ctx.bezierCurveTo(edge, segmentlength/3+offset, edge, (2*segmentlength)/3+offset, middle, segmentlength+offset);
            }
            ctx.stroke();
        }
        addEventListener('load', init);
        addEventListener('resize', drawTimeline);
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
    $categories = DB::table('CategoryLang')->where('fiLanguage', $langId)->pluck('fiCategory');
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

    <header style="background-image: url({{url('images/intro_page/Image7_modif.png')}})">
        <button onclick="copyToClipboard()">
            Share
        </button>
        <h1>{{
            DB::table('CategoryLang')->where('fiCategory', $catId)->where('fiLanguage', $langId)->value('dtText')
            }}</h1>
    </header>
    <div id="menu">
        <ul id="categoryList">
            @foreach($categories as $category)
                <a href= {{route('Timeline', ['category'=> DB::table('CategoryLang')->where('fiLanguage', 1)->where('fiCategory', $category)->first()->dtText, 'languageid' => $languageid])}}>
                    <li>
                        <div class='whiteRectangle'></div>
                        {{DB::table('CategoryLang')->where('fiLanguage', $langId)->where('fiCategory', $category)->first()->dtText}}
                    </li>
                </a>
            @endforeach
        </ul>
        <button id = popupbutton onclick=togglemenu();></button>
    </div>
    <div id="timeline">
        @foreach($events as $eventdata)
            <div class="card alternating_card">
                <h2>{{$eventdata->dtYear}}</h2>
                <h3>{{$eventdata->dtTitle}}</h3>
                <p>{{$eventdata->dtDescription}}</p>
                <button onclick=openDetails({{$eventdata->idEvent}});>Details</button>
            </div>
        @endforeach
        <canvas id="lineCanvas" width="100%" height="100%"></canvas>
    </div>
    <div id="Detailspopup" class="overlay">
        <span class="closebtn" onclick=closeDetails()>Go back</span>
        <div id="overlay" class="overlay-content">

        </div>
    </div>
</body>
</html>

