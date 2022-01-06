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

{{--<div class="splashScreen">--}}
{{--    <img id="test" src='../../images/intro/Image3_modif.png'>--}}
{{--    <img id="test2" src='../../images/intro/Image1_modif.png'>--}}
{{--    <span id="firstTextAnimation">LAM EN CHIFFRE</span>--}}
{{--    <span id="secondTextAnimation">FUTUR</span>--}}
{{--</div>--}}

<ul id="categoryList">
    <?php

    $amountLanguages = DB::table('Language')->count();
    $languages = DB::table('Language')->get();
    $counter = 1;
    $categoryArray = array();

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
            echo " / ";

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

        $url = route('Timeline', ['category' => $categoryText, 'languageid' => $languageid]);
        echo "<a href=$url><li><div class='whiteRectangle'></div>";
        echo $category->dtText;

        $categoryImage = DB::table('Media')->where('idMedia', DB::table('Category')->where('idCategory', $category->fiCategory)->value('fiMedia'))->get();

        foreach ($categoryImage as $image) {
            echo "<img class='draftImg' src='../../images/home/$image->dtPath'></li></a>";
        }

    }

    ?>
    <script>

        let firstText = document.getElementById("firstTextAnimation");
        let secondText = document.getElementById("secondTextAnimation");
        let categoryArray = <?php echo json_encode($categoryArray);?>;
        let counter = -2;
        let secondCounter = -1;


        function swapText() {

            if (counter + 2 < (categoryArray.length)) {
                counter = counter + 2;
                firstText.textContent = categoryArray[counter];
            } else {
                counter = counter + 2 - categoryArray.length;
                firstText.textContent = categoryArray[counter];
            }

        }

        function swapSecondText() {

            if (secondCounter + 2 < (categoryArray.length)) {
                secondCounter = secondCounter + 2;
                secondText.textContent = categoryArray[secondCounter];
            } else {
                secondCounter = secondCounter + 2 - categoryArray.length;
                secondText.textContent = categoryArray[secondCounter];
            }

        }

        setInterval(swapText, 8000)
        swapText();

        setTimeout(function () {
            setInterval(swapSecondText, 8000)
            swapSecondText();
        }, 4000);

    </script>
</ul>
</body>
</html>

