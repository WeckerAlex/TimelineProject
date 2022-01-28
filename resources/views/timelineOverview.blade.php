<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/timelineOverview.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/colors.css') }}">
    <title>LAM125 - Timeline</title>
    <link rel="shortcut icon" href="../../images/LTAM-logo.png">
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
            menu.style.top = isMenuShown ? 'calc(var(--headerheight) - var(--menuheight))' : 'var(--headerheight)';
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
            if (eventSelected){
                const eventId = {{is_null($eventId) ? 0 : $eventId}};
                scroll(0, document.getElementById("Event" + eventId).offsetTop);
                openDetails(eventId,{{$langId}});
            }
        }
        function drawTimeline(){
            let timelineArea = document.getElementById("timeline");
            var svg = document.getElementById('lineImage'); //Get svg element
            var cardArray = [];
            for(var card = 0; card < document.getElementsByClassName("card").length; card++)
                cardArray.push(document.getElementsByClassName("card")[card].offsetTop);
            console.log(cardArray.at(-1));
            // svg.style.height = timelineArea.scrollHeight-2*50+"px";
            svg.style.height = cardArray.at(-1)+15+"px";
            var newElement = document.createElementNS("http://www.w3.org/2000/svg", 'circle'); //Create a path in SVG's namespace
            var svgPath = document.getElementById("Tracé_3");
            var pathlength = svgPath.getTotalLength();
            var pointsCount = document.getElementsByClassName("card").length;
            var shownpart = (timelineArea.scrollHeight-2*50)/pathlength * 1.14;
            var point;
            for (var i = 0; i < pointsCount; i ++) {
                let distance = (i * pathlength * shownpart)/(pointsCount);
                newElement = document.createElementNS("http://www.w3.org/2000/svg", 'circle'); //Create a path in SVG's namespace
                point = svgPath.getPointAtLength(distance);
                // console.log(svgPath.offsetWidth)
                // console.log(distance);
                // console.log(point);
                // console.log((point.x-2690).toString());
                // console.log(distance.toString());
                newElement.setAttribute("cx",((point.x-2480)).toString()); //Set path's data
                // newElement.setAttribute("cy",((point.y-600)).toString()); //Set path's data
                newElement.setAttribute("cy",cardArray[i].toString()); //Set path's data
                newElement.setAttribute("r",(Math.ceil(Math.random()*10)+10).toString()); //Set path's data
                svg.appendChild(newElement);
                // for (var x = 0; x < timelineSVG.scrollWidth; x ++){
                //     console.log(x);
                //     console.log(svgPath.isPointInStroke(newElement));
                //     newElement.setAttribute("cx",x.toString());
                //     if (svgPath.isPointInStroke(newElement)){
                //         break
                //     }
                //     // console.log("App");
                //     svg.appendChild(newElement);
                // }
            }
        }
        function drawpoint(y){
            var canvas = document.getElementById("lineImage");
        }
        addEventListener('load', init);
        addEventListener('resize', drawTimeline);
    </script>
    <script src="{{ URL('js/eventDetails.js') }}" defer></script>
</head>

<body>
    <header>
        <div class="background" id="headerscreen" style="background-image: url({{ url('images/intro/'.$imagePath)}})">
            <button onclick="copyToClipboard()">
                <svg id="Komponente_17_3" class="shareSymbol" data-name="Komponente 17 – 3" xmlns="http://www.w3.org/2000/svg" width="58" height="69" viewBox="0 0 58 69">
                    <g id="Gruppe_61" data-name="Gruppe 61" transform="translate(-94 -96)">
                        <circle id="Ellipse_10" data-name="Ellipse 10" cx="11" cy="11" r="11" transform="translate(94 96)" fill="#912e22"/>
                        <ellipse id="Ellipse_11" data-name="Ellipse 11" cx="11" cy="10.5" rx="11" ry="10.5" transform="translate(130 118)" fill="#912e22"/>
                        <circle id="Ellipse_12" data-name="Ellipse 12" cx="11" cy="11" r="11" transform="translate(94 143)" fill="#912e22"/>
                        <line id="Linie_1" data-name="Linie 1" x1="39.035" y2="25.778" transform="translate(104.956 128.29)" fill="none" stroke="#912e22" stroke-width="3"/>
                        <line id="Linie_2" data-name="Linie 2" x2="36.089" y2="21.359" transform="translate(104.956 106.932)" fill="none" stroke="#912e22" stroke-width="3"/>
                    </g>
                </svg>
                {{--                <img class="shareSymbol" src="{{url('images/intro/Share_Button.png')}}">--}}
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
                <div class="cardButton" onclick=openDetails({{$eventdata->idEvent}},{{$langId}});>
                    <div>Details</div>
                </div>
            </div>
        @endforeach
{{--        <canvas id="lineCanvas"  width="100" height="1000">--}}
{{--            <img id="lineImage" src="{{url('images/intro/Timeline.svg')}}" alt="" />--}}
                        <svg id="lineImage" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMaxYMax slice" >
                            <path id="Tracé_3" data-name="Tracé 3" d="M2710.841,607.827s-217.778,221.028-94.262,604.576,266.534,393.3,263.283,796.35-266.534,585.074-204.776,887.362,357.545,572.072,302.288,975.123-383.548,442.056-266.533,1004.376,341.293,412.8,312.039,825.6-347.794,500.563-289.287,861.358" transform="matrix(1, 0.017, -0.017, 1, -2461.727, -651.299)" fill="none" stroke="#5f0000" stroke-width="4"/>
{{--                            <circle cx="233" cy="5" r="10"/>--}}
{{--                            <circle cx="233" cy="105" r="10"/>--}}
{{--                            <circle cx="233" cy="205" r="10"/>--}}
{{--                            <circle cx="233" cy="305" r="10"/>--}}
{{--                            <circle cx="233" cy="405" r="10"/>--}}
{{--                            <circle cx="233" cy="5963" r="10"/>--}}
                        </svg>
{{--        </canvas>--}}
    </div>
    <div id="Detailspopup" class="overlay">
        <div id="DetailspopupItems">
{{--            <span class="closebtn" onclick=closeDetails()>Go back</span>--}}
            <svg class="closebtn" xmlns="http://www.w3.org/2000/svg" width="151" height="49" viewBox="0 0 151 49">
                <g id="Composant_25_1" data-name="Composant 25 – 1" transform="translate(0 4)">
                    <text id="GO_BACK" data-name="GO BACK" transform="translate(0 35)" fill="#fff" font-size="37" font-family="Roboto-Thin, Roboto" font-weight="200"><tspan x="0" y="0">GO BACK</tspan></text>
                </g>
            </svg>
            <svg class="sharebtn" data-name="Komponente 17 – 3" xmlns="http://www.w3.org/2000/svg" width="58" height="69" viewBox="0 0 58 69">
                <g id="Gruppe_61" data-name="Gruppe 61" transform="translate(-94 -96)">
                    <circle id="Ellipse_10" data-name="Ellipse 10" cx="11" cy="11" r="11" transform="translate(94 96)" fill="#fff"/>
                    <ellipse id="Ellipse_11" data-name="Ellipse 11" cx="11" cy="10.5" rx="11" ry="10.5" transform="translate(130 118)" fill="#fff"/>
                    <circle id="Ellipse_12" data-name="Ellipse 12" cx="11" cy="11" r="11" transform="translate(94 143)" fill="#fff"/>
                    <line id="Linie_1" data-name="Linie 1" x1="39.035" y2="25.778" transform="translate(104.956 128.29)" fill="none" stroke="#fff" stroke-width="3"/>
                    <line id="Linie_2" data-name="Linie 2" x2="36.089" y2="21.359" transform="translate(104.956 106.932)" fill="none" stroke="#fff" stroke-width="3"/>
                </g>
            </svg>
        </div>
        <div id="overlay" class="overlay-content">

        </div>
    </div>
</body>
</html>
