<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/timelineOverview.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/colors.css') }}">
    <title>LAM125 - Timeline</title>
    <link rel="shortcut icon" href="/images/LTAM-logo.png">
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
                .then(async data => document.getElementById("overlay").innerHTML = await data.text()
            )
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
            // drawTimeline();
            initLine();
            insertPoints();
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

        function initLine() {
            console.log("initLine");
            var svgContainer = document.getElementById('lineImage'); //Get svg container element
            var svg = document.getElementById('svg'); //Get svg element
            var cardArray = [];
            for(var card = 0; card < document.getElementsByClassName("card").length; card++)
                cardArray.push(document.getElementsByClassName("card")[card].offsetTop);
            svgContainer.style.height = cardArray.at(-1)+15+"px";
            svg.style.height = cardArray.at(-1)+15+"px";
            // var path = document.getElementById("path");
            // var minx = 100000000;
            // var maxx = 0;
            // for (var i = 0; i < (cardArray.at(-1) + 15); i = i+10) {
            //     var pos = path.getPointAtLength(i);
            //     if(pos.x<minx){minx=pos.x};
            //     if(pos.x>maxx){maxx=pos.x};
            // }
            // svg.style.width = (maxx-minx) + "px";
            // console.log("minx: " + minx);
            // console.log("maxx: " + maxx);
            svgContainer.style.width = svg.style.width;
        }

        function insertPoints(){
            console.log("Pointcount: "+document.getElementsByClassName("timelinePoint").length)
            for(var cx = document.getElementsByClassName("timelinePoint").length-1; cx > 0; cx--){
                document.getElementsByClassName("timelinePoint")[cx].remove();
            }
            var path = document.getElementById("path");
            var svgContainer = document.getElementById('lineImage');
            for(var card = 0; card < document.getElementsByClassName("card").length; card++){
                let lastIndex = document.getElementsByClassName("card").length-1;
                var posXPoint = svgContainer.offsetLeft;
                if(card==0){
                    posXPoint = posXPoint + insertSinglePoint(document.getElementsByClassName("card")[card].offsetTop-15);
                }
                if(card==lastIndex){
                    posXPoint = posXPoint + insertSinglePoint(document.getElementsByClassName("card")[card].offsetTop+15);
                }
                if(card!=0 && card!=lastIndex){
                    posXPoint = posXPoint + insertSinglePoint(document.getElementsByClassName("card")[card].offsetTop);
                }
                var cardMinX = document.getElementsByClassName("card")[card].offsetLeft;
                var cardMaxX = cardMinX + document.getElementsByClassName("card")[card].offsetWidth;
                //check if card lies on line
                if(cardMinX<posXPoint && cardMaxX>posXPoint){
                    console.log("cardMinX: "+ cardMinX+" posXPoint: "+ posXPoint+" posXPoint: "+ posXPoint);
                    var cardElement = document.getElementsByClassName("card")[card];
                    var screenpos = window.getComputedStyle(cardElement).getPropertyValue('float');
                    if (screenpos = "left"){
                        //move card to left
                        var screenposright = window.getComputedStyle(cardElement).getPropertyValue('right');
                        console.log("right: " + screenposright);
                        cardElement.style.left = 0 + "px";
                    }else{
                        //move card to right
                        var screenposleft = window.getComputedStyle(cardElement).getPropertyValue('left');
                        console.log("left: " + screenposleft);
                        cardElement.style.right = 0 + "px";
                    }
                }
            }

            // Move obj element along path based on percentage of total length
            function insertSinglePoint(position) {
                // Get x and y values at a certain point in the line
                var pt = getDistanceAtHeight(position);
                pt.x = Math.round(pt.x);
                pt.y = Math.round(pt.y);

                //add Point
                var svgContainer = document.getElementById('lineImage'); //Get svg container element
                var newDiv = document.createElement("div");
                var radius =Math.ceil(Math.random()*18)+10;
                newDiv.style.transform = 'translate3d(' + pt.x + 'px,' + pt.y + 'px, 0)';
                newDiv.classList.add('timelinePoint');
                newDiv.style.width = 2*radius + "px";
                newDiv.style.height = 2*radius + "px";
                newDiv.style.borderRadius = radius + "px";
                newDiv.style.top = "-" + radius + "px";
                newDiv.style.left = "-" + radius + "px";
                svgContainer.appendChild(newDiv);
                return pt.x;
            }
            function getDistanceAtHeight(height){
                var pt = path.getPointAtLength(height);
                var distance = height;
                if(pt.y != height){
                    while (Math.abs(pt.y - height)>1){
                        distance = distance + ((pt.y - height)<0 ? height-pt.y : pt.y - height);
                        pt = path.getPointAtLength(distance);
                    }
                }
                return pt
            }
        }
        addEventListener('load', init);
        addEventListener('resize', init);
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
                <svg class="cardButton" data-name="Composant 24 – 2" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" width="178" height="52" viewBox="0 0 178 52"
                     onclick=openDetails({{$eventdata->idEvent}},{{$langId}})>
                    <defs>
                        <clipPath id="clip-path">
                            <rect id="Rectangle_23" data-name="Rectangle 23" width="178" height="52" rx="26"
                                  transform="translate(799 622)" fill="#912e22" stroke="#707070" stroke-width="1" />
                        </clipPath>
                    </defs>
                    <g id="Groupe_de_masques_1" data-name="Groupe de masques 1" transform="translate(-799 -622)"
                       clip-path="url(#clip-path)">
                        <g id="pictures" transform="translate(-90 -329)">
                            <rect id="Rectangle_22" data-name="Rectangle 22" width="178" height="52" rx="26"
                                  transform="translate(889 951)" fill="#000"/>
                            <text id="pictures-2" data-name="pictures" transform="translate(960 985)" fill="#fff" font-size="25"
                                  font-family="Roboto-Thin, Roboto" font-weight="200" opacity="1">
                                <tspan x="-22" y="0">images</tspan>
                            </text>

                        </g>
                        <g id="more">
                            <rect id="Rectangle_22-2" data-name="Rectangle 22" width="178" height="52" rx="26"
                                  transform="translate(889 951)" fill="#912e22" />
                            <text id="more-2" data-name="more" transform="translate(978 986)" fill="#fff" font-size="25"
                                  font-family="Roboto-Thin, Roboto" font-weight="200">
                                <tspan x="-28" y="0">more</tspan>
                            </text>
                        </g>

                    </g>
                </svg>
            </div>
        @endforeach
            <div id="lineImage">
                <svg id="svg" width="554.699" height="500" preserveAspectRatio="xMidYMin slice"
                     viewBox="0 0 554.699 5963.434">
                    <path id="path"
                          d="M140,0s-217.778,221.028-94.262,604.576,266.534,393.3,263.283,796.35-266.534,585.074-204.776,887.362,357.545,572.072,302.288,975.123-383.548,442.056-266.533,1004.376,341.293,412.8,312.039,825.6-347.794,500.563-289.287,861.358"
                          fill="none" stroke="#5f0000" stroke-width="4" />
                </svg>
            </div>
    </div>
    <div id="Detailspopup" class="overlay">
        <div id="DetailspopupItems">
{{--            <span class="closebtn" onclick=closeDetails()>Go back</span>--}}
            <svg class="closebtn" xmlns="http://www.w3.org/2000/svg" width="151" height="49" viewBox="0 0 151 49" onclick="closeDetails()">
                <g id="Composant_25_1" data-name="Composant 25 – 1" >
                    <text id="GO_BACK" data-name="GO BACK" transform="translate(0 35)" fill="#fff" font-size="37" font-family="Roboto-Thin, Roboto" ><tspan x="0" y="0">GO BACK</tspan></text>
                </g>
            </svg>
            <svg class="sharebtn" data-name="Komponente 17 – 3" xmlns="http://www.w3.org/2000/svg" width="58" height="69" viewBox="0 0 58 69" onclick="copyToClipboard()">
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
