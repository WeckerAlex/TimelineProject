<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>LAM125 - Introduction</title>
    <style>
        *{
            text-align: left;
            font-family: Roboto;
            font-style: normal;
            color: rgba(255,255,255,1);
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

        body{
            background-color: rgba(181,21,21,1);
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

    ?>
</body>
</html>

