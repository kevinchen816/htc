<?php

/*----------------------------------------------------------------------------------*/
$table->increments('id');           数据库主键自增ID
$table->bigIncrements('id');        自增ID，类型为bigint (目前使用这一个)
$table->rememberToken();            添加一个remember_token 列： VARCHAR(100) NULL.

$table->char('name', 4);            等同于数据库中的 CHAR 类型
$table->string('email');            等同于数据库中的 VARCHAR 列  (65535) .
$table->string('name', 100);        等同于数据库中的 VARCHAR，带一个长度
$table->text('description');        等同于数据库中的 TEXT 类型 (65535 = 2^16-1)
$table->mediumText('description');  等同于数据库中的 MEDIUMTEXT 类型 (16777215 = 2^24-1)
$table->longText('description');    等同于数据库中的 LONGTEXT 类型 (4294967295 = 2^32-1)
$table->json('options');            等同于数据库中的 JSON 类型
$table->jsonb('options');           等同于数据库中的 JSONB 类型

$table->tinyInteger('numbers');     等同于数据库中的 TINYINT 类型     (0-255)         0xff
$table->smallInteger('votes');      等同于数据库中的 SMALLINT 类型    (0-65535)       0xffff
$table->mediumInteger('numbers');   等同于数据库中的 MEDIUMINT类型    (0-16777215)    0xffff ff
$table->integer('votes');           等同于数据库中的 INTEGER 类型     (0-4294967295)  0xffff ffff
$table->bigInteger('votes');        等同于数据库中的 BIGINT 类型      (0-18446744073709551615)

$table->decimal('amount', 5, 2);    等同于数据库中的 DECIMAL 类型，带一个精度和范围
$table->double('column', 15, 8);    等同于数据库中的 DOUBLE 类型，带精度, 总共15位数字，小数点后8位.
$table->float('amount');            等同于数据库中的 FLOAT 类型

$table->date('created_at');         等同于数据库中的 DATE 类型        (1000-01-01 ~ 9999-12-31)
$table->time('sunrise');            等同于数据库中的 TIME 类型        (-838:59:59 ~ 838:59:59)
$table->dateTime('created_at');     等同于数据库中的 DATETIME 类型    (1000-01-01 00:00:00 ~ 9999-12-31 23:59:59)
$table->timestamp('added_on');      等同于数据库中的 TIMESTAMP 类型   (1970-01-01 ~ 2038-01-09)
$table->timestamps();               添加 created_at 和 updated_at 列
$table->nullableTimestamps();       和 timestamps() 一样但允许 NULL值
$table->softDeletes();              新增一个 deleted_at 列 用于软删除 (TIMESTAMP 类型)

$table->binary('data');             等同于数据库中的 BLOB 类型
$table->boolean('confirmed');       等同于数据库中的 BOOLEAN 类型

$table->enum('choices', ['foo', 'bar']);    等同于数据库中的 ENUM类型
$table->morphs('taggable');         添加一个 INTEGER 类型的 taggable_id 列和一个 STRING类型的 taggable_type列
$table->uuid('id');                 等同于数据库的 UUID

/*----------------------------------------------------------------------------------*/
# 在修改字段之前，请确保将 doctrine/dbal 依赖添加到 composer.json 文件中。
$ composer require doctrine/dbal

$table->string('name', 50)->change();               // 将name列的尺寸从 25 增加到 50
$table->string('name', 50)->nullable()->change();   // 修改该列允许 NULL 值
$table->renameColumn('from', 'to');                 // 重命名列 (注意：暂不支持 enum类型的列的重命名)

$table->dropColumn('votes');                        // 删除列
$table->dropColumn(['votes', 'avatar', 'location']);// 删除多个列

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