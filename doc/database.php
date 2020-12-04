<?php

//---------------------------------------------------------------------------------
// $event = DB::table('events')->where('event_id', $request->eid)->first();
$event = Event::where('event_id', $request->eid)->first();

$event->status = 2;
$event->update();

--> 需要使用 Event::where(...)->first() 的方式，才可以使用 update() 更新數據

/*
    注意 - 使用 Trace:: 与 DB::table('traces') 在取得时间数据时会不一样
*/
// $traces = Trace::where('event_id', $request->eid)->get();
$traces = DB::table('traces')->where('event_id', $request->eid)->get();
foreach ($traces as $trace) {
    /*
        $traces = Trace::where('event_id', $request->eid)->get();
        "time": [
            {
                "date": "2020-12-01 01:14:28.000000",
                "timezone_type": 3,
                "timezone": "PRC"
            },
            {
                "date": "2020-12-01 01:14:34.000000",
                "timezone_type": 3,
                "timezone": "PRC"
            }
        ]

        $traces = DB::table('traces')->where('event_id', $request->eid)->get();
        "time": [
            "2020-12-01 01:14:28",
            "2020-12-01 01:14:34"
        ]
    */
    // $t_carbon = new Carbon($trace->created_at);
    // $time[] = $t_carbon->timestamp;  // 使用 Trace:: 与 DB::table('traces') 会一样
    $time[] = $trace->created_at;       // 使用 Trace:: 与 DB::table('traces') 会不一样

    $position[] = $trace->lat.','.$trace->lng;

    $address[] = $trace->address;
    // $data[] = $trace;
}

$ret['result'] = 0;
$ret['time'] = $time;
$ret['position'] = $position;
$ret['address'] = $address;
// $ret['data'] = $data;

//---------------------------------------------------------------------------------
$db = DB::select('select * from plan_products');
var_dump($db);
dd($db);

//---------------------------------------------------------------------------------
Laravel 使用多个数据库连接
https://learnku.com/articles/16414/laravel-uses-multiple-database-connections


$php artisan make:model Models/Users -m

//$php artisan make:migration create_users_table --create=users

class PlanHistory extends Model
{

    protected $table = 'plan_history';
}