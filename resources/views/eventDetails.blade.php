<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/colors.css') }}">
    <title>LAM125 - Event</title>
    <style>
        .headfonts, .descriptionContent{
            text-align: left;
            font-family: Roboto;
            font-style: normal;
            color: #ffffff;
        }

        .descriptionContent{
            margin-left: 3%;
            margin-right: 3%;
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
            margin-left: 3%;
        }

        #eventImg, figure{
            border-radius: 8px;
            display: block;
            margin-top: 5vh;
            margin-left: auto;
            margin-right: auto;
            width: 20vw;
        }
    </style>
</head>
<body>

    <?php

    $event = DB::table('EventLang')->where('fiLanguage', $languageid)->where('fiEvent', $eventid)->get();

    foreach ($event as $singleEvent) {
        $eventyear = DB::table('Event')->where('idEvent', $singleEvent->fiEvent)->get();
        foreach ($eventyear as $singleEventyear) {
            echo "<div><span id='year' class='headfonts'>".$singleEventyear->dtYear."</span></div>";
        }
        echo "<div><span id='title' class='headfonts'>".$singleEvent->dtTitle."</span></div>";
        echo "<p class='descriptionContent'>".$singleEvent->dtDescription."</p>";
        echo "<p class='descriptionContent'>".$singleEvent->dtContent."</p>";
    }

    $categoryImage = DB::table('Media')->where('fiEvent', $eventid)->get();

    foreach ($categoryImage as $image) {
        $copyright="&#169";
        if($image->dtCopyright== null || $image->dtCopyright == ""){
            $copyright="";
        }
        echo "<figure><img id='eventImg' src='../../images/gallerie/$image->dtPath'><caption>$copyright $image->dtCopyright</caption></figure>";
    }

    ?>
</body>
</html>