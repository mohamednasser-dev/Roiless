<?php
function getlogoimage(){
    $setting = \App\Models\Setting::get()->first();
    return $setting;
}



function msgdata($request, $status, $key, $data)
{
    $msg['status'] = $status;
    $msg['msg'] = Config::get('response.' . $key . '.' . $request->header('lang'));
    $msg['data'] = $data;
    return $msg;
}
