<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/introduction.css') }}">
<!--<link rel="stylesheet" type="text/css" href="{{ URL('css/colors.css') }}">-->
    <title>LAM125 - Introduction</title>
</head>
<body>

<ul id="categoryList">
    <?php

    $amountLanguages = DB::table('Language')->count();
    $languages = DB::table('Language')->get();
    $counter = 1;

    echo "<div id='languageChoice'>";

    foreach ($languages as $language) {

        if ($counter != $amountLanguages) {
            echo "<a class='langLink' href='/Timeline/$language->dtIso_code'>$language->dtIso_code</a> / ";
        } else {
            echo "<a class='langLink' href='/Timeline/$language->dtIso_code'>$language->dtIso_code</a>";
        }
        $counter++;

    }


    echo "</div>";

    $check1 = DB::table('Language')->where('dtIso_code', $languageid)->count();

    if ($check1 <> 1) {
        header("Location: " . route("home"));
        exit();
    }

    $langId = DB::table('Language')->where('dtIso_code', $languageid)->value('idLanguage');



    $categories = DB::table('CategoryLang')->where('fiLanguage', $langId)->get();
    foreach ($categories as $category) {

        $french = DB::table('CategoryLang')->where('fiLanguage', 1)->where('fiCategory', $category->fiCategory)->get();

        foreach ($french as $frenchText) {
            $categoryText = $frenchText->dtText;
        }

        $url = route('Timeline', ['category' => $categoryText, 'languageid' => $languageid]);
        echo "<a href=$url><li><div class='whiteRectangle'></div>";
        echo $category->dtText;
        echo "<img class='draftImg' src='../../images/intro/Image1_modif.png'></li></a>";

    }
    ?>
</ul>
</body>
</html>

