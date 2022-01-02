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
        var isMenuDisplayed = false

        async function openDetails(eventId,languageId) {
            document.getElementById("Detailspopup").style.display = "block";
            document.body.style.overflow = "hidden";
            verticalOffset = window.pageYOffset || document.documentElement.scrollTop;
            window.scrollTo(0, 0);
            //show Details
            fetch(`/Timeline/Event/${eventId}/${languageId}`)
                .then(async data => document.getElementById("overlay").innerHTML = await data.text());
        }

        // Close the full screen search box
        function closeDetails() {
            document.getElementById("Detailspopup").style.display = "none";
            document.body.style.overflow = "scroll";
            window.scrollTo(0, verticalOffset);
        }

        function togglemenu(){
            console.log("menu Toggle");
            var menu = document.getElementById("menu");
            menu.style.top = isMenuShown ? "0vw" : "48vw";
            isMenuShown = !isMenuShown;
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
            var startoffset = 100;
            canvas.style.height = timelineArea.scrollHeight+"px";
            canvas.height = timelineArea.scrollHeight;
            canvas.width = window.innerWidth;

            var ctx = canvas.getContext("2d");
            var width = canvas.width;
            var height = canvas.height;
            var middle = width/2;
            var segmentcount = document.getElementsByClassName("card").length/2;
            var segmentlength = height/segmentcount;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.lineWidth = 15;
            ctx.strokeStyle = getComputedStyle(document.body).getPropertyValue('--highlightred');

            //draw timeline
            ctx.beginPath();
            ctx.moveTo(width, startoffset);//move cursor to top middle
            var offset = 0;
            var edge;
            for (let i = 0; i<segmentcount-1; i++){
                offset = i * segmentlength+startoffset;
                edge = ((i % 2) ? width : 0);
                ctx.bezierCurveTo(edge, segmentlength/3+offset, edge, (2*segmentlength)/3+offset, middle, segmentlength+offset);
            }
            ctx.stroke();
        }
        function drawpoint(y){
            var canvas = document.getElementById("lineCanvas");
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

    <header>
        <div class="background" id="headerscreen" style="background-image: url({{url('images/home/Image6_modif@2x.png')}})">
            <button onclick="copyToClipboard()">
                <div id="SharebuttonText">Share</div>
                <img class="shareSymbol" src="{{url('images/intro/Share_Button.png')}}">
            </button>
            <h1>
                {{DB::table('CategoryLang')->where('fiCategory', $catId)->where('fiLanguage', $langId)->value('dtText')}}
            </h1>
        </div>
        <div class="background" ></div>
        <div id="menu">
            <div id="languageChoice" style="cursor: default">
                @foreach (DB::table('Language')->pluck('dtIso_code') as $language)
                    @if(strtolower($language) == strtolower($languageid))
                        {{$language}}
                    @else
                        <a class='langLink' href={{route('Timeline', ['category' => $id, 'languageid' => $language])}}>{{$language}}</a>
                    @endif
                    @if (!$loop->last)
                        /
                    @endif
                @endforeach
            </div>
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
            <button id=popupbutton onclick=togglemenu();>
                <div class="triangle triangle-down"></div>
            </button>
        </div>
    </header>

    <div id="timeline">
        @foreach($events as $eventdata)
            <div class="card alternating_card">
                <h2>{{$eventdata->dtYear}}</h2>
                <h3>{{$eventdata->dtTitle}}</h3>
                <p>{{$eventdata->dtDescription}}</p>
                <button onclick=openDetails({{$eventdata->idEvent}},{{$langId}});>Details</button>
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

