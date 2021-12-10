<?php
use Illuminate\Support\Facades\DB;

$users = DB::select('select * from EventLang');

foreach ($users as $user) {
    echo "<li class='categories'>$user->dtTitle</li>";
}
?>