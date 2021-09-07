<?php
function getlogoimage(){
    $setting = \App\Models\Setting::get()->first();
    return $setting;
}
