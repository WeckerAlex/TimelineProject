<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL('css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL('css/eventDetails.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pannellum/2.5.6/pannellum.css"
          integrity="sha512-UoT/Ca6+2kRekuB1IDZgwtDt0ZUfsweWmyNhMqhG4hpnf7sFnhrLrO0zHJr2vFp7eZEvJ3FN58dhVx+YMJMt2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>LAM125 - Event</title>
</head>
<body>
@php
    use Illuminate\Support\Str;
        $event = DB::table('EventLang')->where('fiLanguage', $languageid)->where('fiEvent', $eventid)->get();
        $categoryImage = DB::table('Media')->where('fiEvent', $eventid)->get();

@endphp



@foreach ($event as $singleEvent)
    @php
        $eventyear = DB::table('Event')->where('idEvent', $singleEvent->fiEvent)->get();
        $imageNumber = 0;
    @endphp
    @foreach ($eventyear as $singleEventyear)
        <div><span id='year' class='headfonts'>{{$singleEventyear->dtYear}}</span></div><br>
        <div><span id='title' class='headfonts'>{{$singleEvent->dtTitle}}</span></div><br>
    @endforeach



    <div class="generalMain">
        <aside class="gallery">
            @foreach ($categoryImage as $image)
                @php
                    $imageNumber++;
                @endphp

                <figure>
                    <img id='eventImg' src='/images/gallerie/{{$image->dtPath}}' onclick="openModal();currentSlide({{$imageNumber}})" class="hover-shadow cursor">
                </figure><br>

            @endforeach
        </aside>

        <section class="generalSection">
            <div class='descriptionContent'>

                @if($singleEvent->dtDescription != null)
                    @php
                        $htmlDescription = Str::markdown($singleEvent->dtDescription);
                    @endphp
                    {!! $htmlDescription !!}
                @endif
            </div>
            <br>

            <div class='descriptionContent'>
                @php
                    $html = Str::markdown($singleEvent->dtContent);
                @endphp

                {!! $html !!}
            </div>
        </Section>
    </div>

    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content">

            @foreach ($categoryImage as $image)
                <div class="mySlides">
                    <img src='/images/gallerie/{{$image->dtPath}}' style="width:25vw">
                </div>
                <div class="caption-container">
                    <p id="caption">{{$image->dtCopyright}}</p>
                </div>
            @endforeach

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>
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