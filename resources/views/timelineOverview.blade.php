<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ URL('css/timelineOverview.css') }}">
    <title>Timeline</title>
</head>

<body>
<?php
    $check1 = DB::table('Language')->where('dtIso_code', $languageid)->count();
    $check2 = DB::table('CategoryLang')->where('dtText', $id)->where('fiLanguage', 1)->count();
    if ($check1 <> 1 or $check2 <> 1){
        echo "Problem";
        header("Location: ".route("home"));
        exit();
    }
    $langId = DB::table('Language')->where('dtIso_code', $languageid)->value('idLanguage');
    $catId = DB::table('CategoryLang')->where('dtText', $id)->where('fiLanguage', 1)->value('fiCategory');
    $categories = DB::table('CategoryLang')->where('fiLanguage', $langId)->pluck('dtText');
?>
    <header style="background-image: url({{url('images/intro_page/Image7_modif@2x.png')}})">
        <h1>{{
            DB::table('CategoryLang')->where('fiCategory', $catId)->where('fiLanguage', $langId)->value('dtText')
            }}</h1>
    </header>
    <div id="popup">
        <ul id="categoryList">
            <?php
            foreach ($categories as $category) {
                echo "<li>$category</li>";
            }
            ?>
        </ul>
        <div id = popupbutton>

        </div>
    </div>

</body>
</html>

