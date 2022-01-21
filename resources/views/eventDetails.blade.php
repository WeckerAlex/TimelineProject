<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/colors.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pannellum/2.5.6/pannellum.css"
          integrity="sha512-UoT/Ca6+2kRekuB1IDZgwtDt0ZUfsweWmyNhMqhG4hpnf7sFnhrLrO0zHJr2vFp7eZEvJ3FN58dhVx+YMJMt2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>LAM125 - Event</title>
    <style>
        #panorama-360-view {
            width: 100vw;
            height: 100vh;
        }

        .headfonts, .descriptionContent{
            text-align: left;
            font-family: Roboto;
            font-style: normal;
            color: #ffffff;
        }

        .descriptionContent{
            margin-left: 10%;
            margin-right: 10%;
            text-align: justify;
        }

        #year{
            font-weight: lighter;
            font-size: 109px;
            text-transform: uppercase;
            margin-left: 2%;
        }

        #title{
            font-weight: normal;
            font-size: 70px;
            margin-left: 5%;
        }

        #eventImg, figure{
            border-radius: 8px;
            display: block;
            margin-top: 5vh;
            margin-left: auto;
            margin-right: auto;
            width: 20vw;
            box-shadow: 0 14px 10px 4px rgba(0,0,0,0.1);
        }

        iframe{
            margin-left: auto;
            margin-right: auto;
        }

        p, ul, ol{
            margin-bottom: 1vw;
        }
    </style>
</head>
<body>
    @php
        use Illuminate\Support\Str;
            $event = DB::table('EventLang')->where('fiLanguage', $languageid)->where('fiEvent', $eventid)->get();
            $categoryImage = DB::table('Media')->where('fiEvent', $eventid)->get();
    @endphp

    @foreach ($event as $singleEvent)
        @php
          $eventyear = DB::table('Event')->where('idEvent', $singleEvent->fiEvent)->get()
        @endphp
        @foreach ($eventyear as $singleEventyear)
            <div><span id='year' class='headfonts'>{{$singleEventyear->dtYear}}</span></div>
        @endforeach
            <div><span id='title' class='headfonts'>{{$singleEvent->dtTitle}}</span></div><br>
            <div class='descriptionContent'>
                @php
                    $htmlDescription = Str::markdown($singleEvent->dtDescription);
                @endphp
                {!! $htmlDescription !!}
            </div><br>
            <div class='descriptionContent'>
                @php
                    $html = Str::markdown($singleEvent->dtContent);
                @endphp

                {!! $html !!}
            </div>
    @endforeach

    @foreach ($categoryImage as $image)
        @php
            $copyright="&#169"
        @endphp
        @if($image->dtCopyright== null || $image->dtCopyright == "")
            @php
              $copyright=""
            @endphp
        @endif
        <figure><img id='eventImg' src='../../images/gallerie/{{$image->dtPath}}'><caption>{{$copyright}} {{$image->dtCopyright}}</caption></figure><br>
    @endforeach


    <!--
    <iframe width="600px" height="350px" frameborder="0" src="https://momento360.com/e/u/a9f0706cff9d4facb1390d69e76ff5d8?utm_campaign=embed&utm_source=other&utm_medium=other&heading=0&pitch=0&field-of-view=100">

    </iframe>



    <div id="panorama-360-view"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pannellum/2.5.6/pannellum.js"
            integrity="sha512-EmZuy6vd0ns9wP+3l1hETKq/vNGELFRuLfazPnKKBbDpgZL0sZ7qyao5KgVbGJKOWlAFPNn6G9naB/8WnKN43Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="main.js"></script>
-->
</body>
</html>