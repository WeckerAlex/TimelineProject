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
        var isMenuDisplayed = false;
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
            menu.style.top = isMenuShown ? 'calc(48vw - var(--menuheight))' : "48vw";
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
            const eventSelected = {{is_null($eventId) ? "false" : "true"}};
            const eventId = {{is_null($eventId) ? 0 : $eventId}};
            const eventelement = document.getElementById("Event" + eventId);
            const offset = eventelement.offsetTop;
            scroll(0, offset);
            if (eventSelected){
                openDetails(eventId,{{$langId}});
            }
        }
        function drawTimeline(){
            var timelineArea = document.getElementById("timeline");
            var timelineSVG = document.getElementById("lineCanvas");
            timelineSVG.style.height = timelineArea.scrollHeight-2*50+"px";
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
    <header>
        <div class="background" id="headerscreen" style="background-image: url({{url('images/intro/'.$imagePath)}})">
            <button onclick="copyToClipboard()">
                <div id="SharebuttonText">Share</div>
                <img class="shareSymbol" src="{{url('images/intro/Share_Button.png')}}">
            </button>
            <div id="languageChoice" style="cursor: default">
                @foreach (DB::table('Language')->pluck('dtIso_code') as $language)
                    @if(strtolower($language) == strtolower($languagetxt))
                        {{$language}}
                    @else
                        <a class='langLink' href={{route('Timeline', ['category' => $categorytxt, 'languageid' => $language])}}>{{$language}}</a>
                    @endif
                    @if (!$loop->last)
                        /
                    @endif
                @endforeach
            </div>
            <h1>
                {{DB::table('CategoryLang')->where('fiCategory', $catId)->where('fiLanguage', $langId)->value('dtText')}}
            </h1>
        </div>
        <div class="background" ></div>
        <div id="menu">
            <ul id="categoryList">
                @foreach($categories as $category)
                    <a href= {{route('Timeline', ['category'=> str_replace(" ", "_",DB::table('CategoryLang')->where('fiLanguage', 1)->where('fiCategory', $category)->first()->dtText), 'languageid' => $languagetxt])}}>
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
            <div id="Event{{$eventdata->idEvent}}" class="card alternating_card">
                <h2>{{$eventdata->dtYear}}</h2>
                <h3>{{$eventdata->dtTitle}}</h3>
                <p>{{$eventdata->dtDescription}}</p>
                <button onclick=openDetails({{$eventdata->idEvent}},{{$langId}});>
                    Details
{{--                    <span class="btn-overlay">--}}
{{--                        <i class="fa fa-refresh fa-spin"></i>--}}
{{--                    </span>--}}
                </button>
            </div>
        @endforeach
        <img id="lineCanvas" src="{{url('images/intro/Timeline.svg')}}" alt="" />
    </div>
    <div id="Detailspopup" class="overlay">
        <span class="closebtn" onclick=closeDetails()>Go back</span>
        <div id="overlay" class="overlay-content">

        </div>
    </div>
</body>
</html>
