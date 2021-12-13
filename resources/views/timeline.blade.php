<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { padding: 0; margin: 0; }
        body, html {
            background-color: rgba(181, 21, 21, 1);
            height: 100vh;
            display: table;
        }

        #categoryList {
            color: white;
            list-style-type: none;
            height: 100%;
            font-weight: bold;
            display: table;
        }

        ul li {
            font-size: 70px;
            display: table-row;
            font-style: normal;
        }

    </style>
</head>
<body>

<ul id="categoryList">
<?php

    $categories = DB::table('CategoryLang')->get();
foreach ($categories as $category) {
    echo "<li>";
    echo $category->dtText;
    echo "</li>";
}
?>
</ul>
</body>
</html>

