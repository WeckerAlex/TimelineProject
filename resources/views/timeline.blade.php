<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>LAM125 - Introduction</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body, html {
            background-color: #912E22;
            height: 90vh;
            width: 60vw;
        }

        #categoryList {
            display: flex;
            position: relative;
            align-items: stretch;
            flex-direction: column;
            justify-content: space-between;
            height: 92vh;
            width: 90vw;
            margin-top: 4vh;
            margin-bottom: 4vh;
        }

        li, .whiteRectangle, .test {
            display: inline-block;
            list-style-type: none;
            color: white;
            font-family: Roboto;
            font-size: 4vw;
            font-weight: bolder;
            transition: 0.3s;
        }

        .whiteRectangle {
            background-color: white;
            width: 7vw;
            margin-left: 2vw;
            margin-right: 1vw;
            height: 6vh;
        }

        .draftImg {
            width: 7vw;
            height: 7vh;
            margin-left: 20vw;
        }

        li:hover > .draftImg {
            transform: scale(1.5);
        }

        li:hover > .whiteRectangle {
            width: 11vw;
            background-color: #5F0000;
        }

        li:hover {
            color: #5F0000;
        }

        #content {
            position: relative;
        }
        #content p {
            position: absolute;
            top: 0px;
            right: 0px;
        }

    </style>
</head>
<body>

<ul id="categoryList">
    <?php

    $check1 = DB::table('Language')->where('dtIso_code', $languageid)->count();

    if ($check1 <> 1){
        header("Location: ".route("home"));
        exit();
    }

    $langId = DB::table('Language')->where('dtIso_code', $languageid)->value('idLanguage');



    $categories = DB::table('CategoryLang')->where('fiLanguage', $langId)->get();
    foreach ($categories as $category) {

        $french = DB::table('CategoryLang')->where('fiLanguage', 1)->where('fiCategory', $category->fiCategory)->get();

        foreach ($french as $frenchText) {
            $categoryText = $frenchText->dtText;
            }

        $url = route('Timeline', ['category'=> $categoryText, 'languageid' => $languageid]);
        echo "<a href=$url><li><div class='whiteRectangle'></div>";
        echo $category->dtText;
        echo "<img class='draftImg' src='../../images/intro/Image1_modif.png'></li></a>";

    }
    ?>
</ul>
</body>
</html>

