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


function msg($request, $status, $key)
{
    $msg['status'] = $status;
    $msg['msg'] = Config::get('response.' . $key . '.' . $request->header('lang'));

    return $msg;
}

function success()
{
    return 200;
}

function failed()
{
    return 401;
}
