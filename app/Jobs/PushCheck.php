<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use JPush\Client as JPush;
use App\Models\Account; // 鱼乐世界（删除无用的推送 ID）
use \Exception;

class PushCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $count;
    protected $push_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct()
    public function __construct($count, $push_id)
    {
        $this->count = $count;
        $this->push_id = $push_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $app_key = '3f5a52de66b60b36ff0417df'; // 鱼乐世界
        $master_secret = '14b1cba7bfeb9354e18e3482';
        $limit = 10000; //5;

        $title = '鱼乐世界';
        $body = '测试';
        // $url = 'http://portal.kmcampro.com/uploads/7/1547295213_xLuPXhn5fe.JPG';

        // echo 'start...';
        // echo $this->push_id.' -> ';

        // $query = Account::query();
        // // $query->where('account', '18664933085');
        // // $query->where('mobile', '13065ffa4e694f9d6dd'); // OK
        // // $query->where('mobile', '1507bfd3f7bbd7fe06d'); // NG
        // // $query->where('os', $os);
        // $query->where('flag', 0);
        // $query->groupBy('mobile');
        // $query->limit($limit);
        // $db = $query->get();

        // $count = 0;
        // foreach ($db as $item) {

            try {
                // $check_push_id = $item->mobile;
                $check_push_id = $this->push_id;
                $count = $this->count;

                // $count++;
                echo '('.$count.') ';
                echo $check_push_id.' -> ';

                $num = Account::where('mobile','=', $check_push_id)->update(['flag'=>2]);

                $client = new JPush($app_key, $master_secret);
                $ret = $client->push()
                    // ->setPlatform('all')
                    ->setPlatform(['ios', 'android'])
                    ->options(['apns_production'=>true]) // IMPORTANT !! must for iOS
                    // ->addAllAudience()
                    // ->addAlias('alias')
                    // ->addTag(array('tag1', 'tag2'))
                    ->addRegistrationId($check_push_id)
                    ->setNotificationAlert('Hello')
                    ->androidNotification($body, array(
                        'title' => $title,
                        // 'extras' => array(
                        //     'url' => $url,
                        // ),
                    ))
                    ->iosNotification(array(
                        'title' => $title,
                        // 'subtitle' => 'subtitle',
                        'body' => $body
                    ), array(
                        // // 'sound' => 'sound.caf',
                        // // // 'badge' => '+1',
                        // // // 'content-available' => true,
                        // // // 'mutable-content' => true,
                        // // 'category' => 'jiguang',
                        // // 'title' => 'Cam #1', // NG
                        // 'extras' => array(
                        //     // 'title' => 'Cam #1',
                        //     'url' => $url,
                        // ),
                    ))
                    ->send();

                // $item->flag = 0;
                // $item->flag = 1;
                // $bool = $item->save();

                echo 'OK, ';
                $num = Account::where('mobile','=', $check_push_id)->update(['flag'=>1]);

                // echo $item->ver.', ';
                // echo $item->account.', ';
                // echo $item->mobile.', ';
                // echo $item->os.', ';
                // echo $item->did.' ';
                // echo '<br>';
                // return dd($ret);

            } catch (Exception $e) { // 注意：代码在最开头使用 use \Exception;
                // print $e->getMessage();

                // $item->flag = 2;
                // $bool = $item->save();
                echo 'NG -> ';
$this->delete();

                // $num = Account::where('mobile','=', $check_push_id)->update(['flag'=>2]);

                // echo $item->ver.', ';
                // echo $item->account.', ';
                // echo $item->mobile.', ';
                // echo $item->os.', ';
                // echo $item->did.' ';
                // echo '<br>';
            }
        // }
    }
}