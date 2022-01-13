<?php
$cookie_name = "playSplash";
$cookie_value = "No";

if (!isset($_COOKIE[$cookie_name])) {
    setcookie($cookie_name, $cookie_value, time() + (86400 * 1 / 8), "/"); // 86400 = 1 day
}
?>
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/introduction.css') }}">
    <title>LAM125 - Introduction</title>
    <link rel="shortcut icon" href="../../images/LTAM-logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

@if(!isset($_COOKIE["playSplash"]))
    <div id="splashScreen">
        <img id="topLeftImage" src='../../images/intro/Image3_modif.png'>
        <img id="topRightImage" src='../../images/intro/Image1_modif.png'>
        <img id="bottomLeftImage" src='../../images/intro/Image5_modif.png'>
        <img id="bottomRightImage" src='../../images/intro/Image2_modif.png'>
        <span id="firstTextAnimation">LAM EN CHIFFRE</span>
        <span id="secondTextAnimation">FUTUR</span>
    </div>
@endif

<ul id="categoryList">
    <?php

    $amountLanguages = DB::table('Language')->count();
    $languages = DB::table('Language')->get();
    $counter = 1;
    $categoryArray = array();
    $imageArray = array();
    $lastItem = "";

    echo "<div id='languageChoice'>";

    foreach ($languages as $language) {

        if ($language->dtIso_code != $languageid) {
            if (strtolower($language->dtIso_code) == $languageid)
                echo "<u>$language->dtIso_code</u>";
            else
                echo "<a class='langLink' href='/Timeline/$language->dtIso_code'>$language->dtIso_code</a>";
        } else {
            echo "<u>$language->dtIso_code</u>";
        }

        if ($counter != $amountLanguages)
            echo " <span id='slash'>/</span> ";

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

        array_push($categoryArray, $category->dtText);

        $french = DB::table('CategoryLang')->where('fiLanguage', 1)->where('fiCategory', $category->fiCategory)->get();

        foreach ($french as $frenchText) {
            $categoryText = $frenchText->dtText;
        }

        $removeSpaces = str_replace(' ', '_', $categoryText);
        $url = route('Timeline', ['category' => $removeSpaces, 'languageid' => $languageid]);
        echo "<a href=$url><li><div class='whiteRectangle'></div>";
        echo $category->dtText;

        $categoryImage = DB::table('Media')->where('idMedia', DB::table('Category')->where('idCategory', $category->fiCategory)->value('fiMedia'))->get();

        foreach ($categoryImage as $image) {

            $categoriesLast = DB::table('CategoryLang')->where('fiLanguage', $langId)->orderby('fiCategory', 'DESC')->first("dtText");

            foreach ($categoriesLast as $last) {
                $lastItem = $last;
            }

            if ($lastItem == $category->dtText)
                echo "<img class='draftImg' src='../../images/home/$image->dtPath'></li></a>";
            else
                echo "</li><img class='draftImg' src='../../images/home/$image->dtPath'></a>";
            array_push($imageArray, $image->dtPath);
        }

    }

    ?>
</ul>

<script>
    let categoryArray = <?php echo json_encode($categoryArray);?>;
    let imageArray = <?php echo json_encode($imageArray);?>;
</script>
<script src="{{ URL('js/timeline_intro.js') }}" defer></script>

</body>
</html>

