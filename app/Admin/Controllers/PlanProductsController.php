<?php

namespace App\Admin\Controllers;

use App\Models\PlanProduct;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use DB;

class PlanProductsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Plan Product') // Index
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Plan Product - Create') // Create
            ->description('description')
            ->body($this->form());
    }

    public function update($id)
    {
        return $this->form()->update($id);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PlanProduct);

        $grid->id('ID');
        $grid->region('Region');
        $grid->currency('Currency');
        $grid->title('Plan');   // Title
        // $grid->description('Description');
        $grid->points('Points');
        // $grid->image('Image');

        // $grid->on_sale('On sale');
        // $grid->on_sale('Active')->display(function ($value) {
        //     return $value ? 'Yes' : 'No';
        // });
        $grid->active('Active')->display(function ($value) {
            return ($value == 1) ? 'Yes' : 'No';
        });

        // $grid->rating('Rating');
        // $grid->sold_count('Sold Count');
        $grid->price('Price');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(PlanProduct::findOrFail($id));

        $show->id('ID');
        $show->region('Region');
        $show->currency('Currency');
        $show->title('Title');
        // $show->description('Description');
        $show->points('Points');
        // $show->image('Image');
        // $show->on_sale('Active');
        $show->active('Active');
        // $show->rating('Rating');
        // $show->sold_count('Sold Count');
        $show->price('Price');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PlanProduct);

        $form->text('region', 'Region');
        $form->text('currency', 'Currency');
        $form->text('title', 'Title');
        // $form->text('description', 'Description');
        $form->text('points', 'Points');
        // $form->image('image', 'Image'); // $ php artisan storage:link

        // $form->switch('on_sale', 'On sale')->default(1);
        // $form->radio('on_sale', 'Active')
        //      ->options(['1' => 'Yes', '0'=> 'No'])
        //      ->default('0');
        $form->radio('active', 'Active')
             ->options(['1' => 'Yes', '0'=> 'No'])
             ->default('0');

        // $form->decimal('rating', 'Rating')->default(5.00);
        // $form->number('sold_count', 'Sold count');
        // $form->decimal('price', 'Price');

        $form->hasMany('skus', 'SKU List', function (Form\NestedForm $form) {
            // $form->text('title', 'SKU Name')->rules('required');
            // $form->text('description', 'SKU Description'); //->rules('required');
            $form->text('month', 'Month')->rules('required');
            $form->text('price', 'Price')->rules('required|numeric|min:0.01');
            $form->text('sub_plan', 'Subscription ID');
            // $form->text('stock', '剩余库存')->rules('required|integer|min:0');

            // $form->radio('on_sale', 'Active')
            //      ->options(['1' => 'Yes', '0'=> 'No'])
            //      ->default('0');
            $form->radio('active', 'Active')
                 ->options(['1' => 'Yes', '0'=> 'No'])
                 ->default('0');
        });

        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
        });

        return $form;
    }

    /*----------------------------------------------------------------------------------*/
    public function build_stripe($p) {
        // \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        \Stripe\Product::create([
          'id' => $p['id'],     //'eu_silver_5000',
          'name' => $p['name'].' ('.$p['id'].')', //'SILVER',
          'type' => 'service',
        ]);

        foreach ($p['plans'] as $plan) {
            // $plan_id = $p['region'].'_'.$p['points'].'_'.$plan['month'].'m'; // 'us_5000_1m'
            // $plan_id = $p['id'].'_'.$plan['month'].'m'; // 'au_basic_1m'
            $plan_id = $p['id'].'_'.$plan['month'].$plan['ymwd']; // 'au_basic_1m'

            if ($plan['ymwd'] == 'y') {
                $interval = 'year';
            } else if ($plan['ymwd'] == 'm') {
                $interval = 'month';
            } else if ($plan['ymwd'] == 'w') {
                $interval = 'week';
            } else if ($plan['ymwd'] == 'd') {
                $interval = 'day';
            }

            \Stripe\Plan::create([
                'product' => $p['id'],
                'id' => $plan_id,
                'interval' => $interval,
                'interval_count' => $plan['month'], // 1,
                'currency' => $p['currency'],       // 'usd',
                'amount' => $plan['amount'],        // 1295,
            ]);
        }
    }

    /*----------------------------------------------------------------------------------*/
    public function build_product($p) {
        $plan_product_id = DB::table("plan_products")->insertGetId([
            'region' => $p['region'],
            'currency' => $p['currency'],
            'title' => $p['name'],
            'description' => $p['description'],
            'points' => $p['points'],
            'data_plans' => $p['data_plans'],
            'active' => $p['active']
        ]);

        foreach ($p['plans'] as $plan) {
            // $plan_id = $p['region'].'_'.$p['points'].'_'.$plan['month'].'m'; // 'us_5000_1m'

            // $plan_id = $p['id'].'_'.$plan['month'].'m'; // 'au_basic_1m'
            $plan_id = $p['id'].'_'.$plan['month'].$plan['ymwd']; // 'au_basic_1m'

            DB::table('plan_product_skus')->insert([
                // 'title' => $p['title'],
                'description' => $plan['description'],
                'active' => $plan['active'],
                'month' => $plan['month'],
                'price' => $plan['amount']/100,
                'plan_product_id' => $plan_product_id,
                'sub_plan' => $plan_id,
            ]);
        }
    }

    /*----------------------------------------------------------------------------------*/
    public function build($type) {
        /* eu */
        $product_eu_basic = array(
            'id' => 'eu_basic',
            'name' => 'BASIC',
            'description' => '5MB per month',
            'points' => 100,
            'data_plans' => 5,
            'region' => 'eu',
            'currency' => 'eur',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>900, 'active'=>1, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>900*3*0.98, 'active'=>0, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>900*6*0.96, 'active'=>0, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>900*12*0.94, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_eu_bronze = array(
            'id' => 'eu_bronze',
            'name' => 'BRONZE',
            'description' => '500MB per month',
            'points' => 10000,
            'data_plans' => 500,
            'region' => 'eu',
            'currency' => 'eur',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>1900, 'active'=>1, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>1900*3*0.98, 'active'=>0, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>1900*6*0.96, 'active'=>0, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>1900*12*0.94, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_eu_silver = array(
            'id' => 'eu_silver',
            'name' => 'SILVER',
            'description' => '1GB per month',
            'points' => 20000,
            'data_plans' => 1024,
            'region' => 'eu',
            'currency' => 'eur',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>2300, 'active'=>1, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>2300*3*0.98, 'active'=>0, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>2300*6*0.96, 'active'=>0, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>2300*12*0.94, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_eu_gold = array(
            'id' => 'eu_gold',
            'name' => 'GOLD',
            'description' => '3GB per month',
            'points' => 60000,
            'data_plans' => 3072,
            'region' => 'eu',
            'currency' => 'eur',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>3600, 'active'=>1, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>3600*3*0.98, 'active'=>0, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>3600*6*0.96, 'active'=>0, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>3600*12*0.94, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_eu_test = array(
            'id' => 'eu_test',
            'name' => 'TEST',
            'description' => '5GB per day',
            'points' => 100000,
            'data_plans' => 5000,
            'region' => 'eu',
            'currency' => 'eur',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'d', 'month'=>1, 'amount'=>100, 'active'=>1, 'description' => 'per Day'],
                ['ymwd'=>'d', 'month'=>2, 'amount'=>102, 'active'=>1, 'description' => 'per 2 Days'],
                ['ymwd'=>'d', 'month'=>3, 'amount'=>103, 'active'=>1, 'description' => 'per 3 Days'],
                ['ymwd'=>'d', 'month'=>7, 'amount'=>107, 'active'=>1, 'description' => 'per 7 Days'],
            ]
        );

        /*------------------------------------------------------------------*/
        /* au */
        $product_au_basic = array(
            // 'id' => 'au_bronze_5m',
            'id' => 'au_basic',
            'name' => 'BASIC',
            'description' => '5MB per month',
            'points' => 100,
            'data_plans' => 5,
            'region' => 'au',
            'currency' => 'aud',
            'active' => 1,
            'plans' => [
                // ['ymwd'=>'m', 'month'=>1, 'amount'=>900, 'active'=>0, 'description' => 'per Month'],
                // ['ymwd'=>'m', 'month'=>3, 'amount'=>900*3*0.98, 'active'=>1, 'description' => 'for 3 Months'],
                // ['ymwd'=>'m', 'month'=>6, 'amount'=>900*6*0.96, 'active'=>1, 'description' => 'for 6 Months'],
                // ['ymwd'=>'m', 'month'=>12, 'amount'=>900*12*0.94, 'active'=>0, 'description' => 'for 12 Months'],

                ['ymwd'=>'m', 'month'=>1, 'amount'=>900, 'active'=>0, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>900*3, 'active'=>1, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>900*6*0.95, 'active'=>1, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>900*12*0.9, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_au_bronze = array(
            'id' => 'au_bronze',
            'name' => 'BRONZE',
            'description' => '500MB per month',
            'points' => 10000,
            'data_plans' => 500,
            'region' => 'au',
            'currency' => 'aud',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>1900, 'active'=>0, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>1900*3, 'active'=>1, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>1900*6*0.95, 'active'=>1, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>1900*12*0.9, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_au_silver = array(
            'id' => 'au_silver',
            'name' => 'SILVER',
            'description' => '1GB per month',
            'points' => 20000,
            'data_plans' => 1024,
            'region' => 'au',
            'currency' => 'aud',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>2300, 'active'=>0, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>2300*3, 'active'=>1, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>2300*6*0.95, 'active'=>1, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>2300*12*0.9, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_au_gold = array(
            'id' => 'au_gold',
            'name' => 'GOLD',
            'description' => '3GB per month',
            'points' => 60000,
            'data_plans' => 3072,
            'region' => 'au',
            'currency' => 'aud',
            'active' => 1,
            'plans' => [
                ['ymwd'=>'m', 'month'=>1, 'amount'=>3600, 'active'=>0, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>3600*3, 'active'=>1, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>3600*6*0.95, 'active'=>1, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>3600*12*0.9, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        $product_au_test = array(
            'id' => 'au_test',
            'name' => 'TEST',
            // 'description' => '5GB per day',
            'description' => '5GB per month',
            'points' => 100000,
            'data_plans' => 5000,
            'region' => 'au',
            'currency' => 'aud',
            'active' => 1,
            'plans' => [
                // ['ymwd'=>'d', 'month'=>1, 'amount'=>100, 'active'=>1, 'description' => 'per Day'],
                // ['ymwd'=>'d', 'month'=>2, 'amount'=>102, 'active'=>1, 'description' => 'per 2 Days'],
                // ['ymwd'=>'d', 'month'=>3, 'amount'=>103, 'active'=>1, 'description' => 'per 3 Days'],
                // ['ymwd'=>'d', 'month'=>7, 'amount'=>107, 'active'=>1, 'description' => 'per 7 Days'],

                ['ymwd'=>'m', 'month'=>1, 'amount'=>100, 'active'=>1, 'description' => 'per Month'],
                ['ymwd'=>'m', 'month'=>3, 'amount'=>103, 'active'=>0, 'description' => 'for 3 Months'],
                ['ymwd'=>'m', 'month'=>6, 'amount'=>106, 'active'=>0, 'description' => 'for 6 Months'],
                ['ymwd'=>'m', 'month'=>12, 'amount'=>112, 'active'=>0, 'description' => 'for 12 Months'],
            ]
        );

        if ($type == 1) {
            /* eu */
            if (env('APP_REGION') == 'au') {
                $this->build_product($product_au_basic);
                $this->build_product($product_au_bronze);
                $this->build_product($product_au_silver);
                $this->build_product($product_au_gold);
                $this->build_product($product_au_test);

            } else if (env('APP_REGION') == 'eu') {
                $this->build_product($product_eu_basic);
                $this->build_product($product_eu_bronze);
                $this->build_product($product_eu_silver);
                $this->build_product($product_eu_gold);
            }

        } else if ($type == 2) {
            $this->build_stripe($product_au_basic);
            $this->build_stripe($product_au_bronze);
            $this->build_stripe($product_au_silver);
            $this->build_stripe($product_au_gold);
            $this->build_stripe($product_au_test);

        } else if ($type == 3) {
            $this->build_stripe($product_eu_basic);
            $this->build_stripe($product_eu_bronze);
            $this->build_stripe($product_eu_silver);
            $this->build_stripe($product_eu_gold);
            $this->build_stripe($product_eu_test);
        }

        return 'build...OK #'.$type;
    }

    /* (1) DB facade */
    public function test1() {
        $db = DB::select('select * from plan_products');
        var_dump($db);
        dd($db);

        // $bool = DB::insert(
        //     'insert into plan_products(region, title, description) value(?,?,?)',
        //     ['au', 'SILVER', '5000 Points per Month']
        // );
        // dd($bool);

        // $bool = DB::update(
        //     'update plan_products set price=? where id=?',
        //     [10, 1]
        // );
        // dd($bool);

        // $num = DB::delete('delete from plan_products where region=?', ['us']);
        // dd($num);
    }

    /* (2) 查询构造器 */
    public function test2() {
        // $db=DB::table("plan_products");
        // dd($db);

        $count=DB::table("plan_products")->count();
        echo 'count= '.$count; echo '<br/>';

        $min=DB::table("plan_products")->min("price");
        echo 'min= '.$min; echo '<br/>';

        $max=DB::table("plan_products")->max("price");
        echo 'max= '.$max; echo '<br/>';

        $avg=DB::table("plan_products")->avg("price");
        echo 'avg= '.$avg; echo '<br/>';

        $sum=DB::table("plan_products")->sum("price");
        echo 'sum= '.$sum; echo '<br/>';

        /* 查询 */
        // $db=DB::table("plan_products")->findOrFail(1); // NG (for Eloquent ORM)
        // $db=DB::table("plan_products")->find(1);
        // dd($db);

        $db=DB::table("plan_products")
            // ->select('region','title', 'price')
            // ->where('price', '>=', 20) // 一个条件
            // ->where([
            //         ['region', '==', 'au'],
            //         ['price', '>=', '20'],
            //     ])
            // ->whereRaw('price >= ? and region = ?', [20, 'au']) // 多个条件
            // ->whereDate('created_at', '2016-10-10') // whereDate / whereMonth / whereDay / whereYear
            // ->orderBy('price','asc') // asc, desc
            ->get(); // 返回多条数据
            // ->first(); // 返回1条数据
        // $db = $db->addSelect('currency')->get();
        dd($db);

        // https://laravelacademy.org/post/6140.html
        // $users = DB::table('users')
        // ->select(DB::raw('count(*) as user_count, status'))
        // ->where('status', '<>', 1)
        // ->groupBy('status')
        // ->get();
        // dd($users);

        /* 新增 */
        // $bool=DB::table("plan_products")->insert([
        //     ['region'=>'au', 'title'=>'SILVER', 'description'=>'5000 Points per Month', 'price'=>10],
        //     ['region'=>'au', 'title'=>'GOLD', 'description'=>'10000 Points per Month', 'price'=>20],
        //     ['region'=>'au', 'title'=>'PLATINUM PRO', 'description'=>'20000 Points per Month', 'price'=>30],
        // ]);
        // dd($bool);

        // 如果想得到新增的id，则使用 insertGetId 方法
        // $id=DB::table("plan_products")->insertGetId(
        //     ['region'=>'au', 'title'=>'SILVER', 'description'=>'5000 Points per Month', 'price'=>10]
        // );
        // dd($id);

        /* 修改 */
        // $bool=DB::table("plan_products")
        //     ->where('region', 'au')
        //     ->update(['price'=>10]);
        // dd($bool);

        // $bool=DB::table("plan_products")
        //     ->where('region', 'au')
        //     ->increment("price");       // 自增 1
        //     // ->increment("price", 3);    // 自增 3
        //     // ->decrement("price");       // 自减 1
        //     // ->decrement("price", 3);    // 自减 3
        // dd($bool);

        // 自增时再修改其他字段
        // $bool=DB::table("plan_products")
        //     // ->where('region', 'au')
        //     ->whereRaw('region = ? and title = ?', ['au', 'SILVER'])
        //     ->increment("price", 3, ['title'=>'XXXXX']);
        //     // ->whereRaw('region = ? and title = ?', ['au', 'XXXXX'])
        //     // ->decrement("price", 4, ['title'=>'SILVER']);
        // dd($bool);

        /* 删除 */
        //Cannot truncate a table referenced in a foreign key constraint
        // $num=DB::table("plan_products")->where('region', 'us')->delete();
        // $num=DB::table("plan_products")->where('price', '=', 9)->delete();
        // $num=DB::table("plan_products")->truncate(); //删除整表，不能恢复，谨慎使用
        // dd($num);

        /* Other */
        // pluck()指定字段,后面不加 get
        // $db=DB::table("plan_products")->pluck('title');
        // dd($db);

        // lists()指定字段，可以指定某个字段作为下标
        // // $db=DB::table("plan_products")->lists('title');   //不指定下标，默认下标从0开始
        // $db=DB::table("plan_products")->lists('title', 'zz');   //指定vip_ID为下标
        // dd($db);

        // //chunk()每次查n条
        // $db=DB::table("plan_products")->chunk(2, function($students){  //每次查2条
        //     var_dump($db);
        //     if(.......) return false;  //在满足某个条件下使用return就不会再往下查了
    }

    /* (3) Eloquent ORM  */
    public function test3() {
        /* 查询 */
        // $db = PlanProduct::all();
        // dd($db);

        // $db = PlanProduct::find(14);
        // $db = PlanProduct::findOrFail(14); // 查找不存在的记录时会抛出异常
        // dd($db);

        //查询构造器的使用,省略了指定表名
        // $db=PlanProduct::get();
        // dd($db);

        /* 新增 */
        // $db = new PlanProduct();
        // $db->region = 'au';
        // $db->title = 'SILVER';
        // $db->description = '5000 Points per Month';
        // $db->price = 10;
        // $bool=$db->save();
        // dd($bool);

// ['region'=>'au', 'title'=>'SILVER', 'description'=>'5000 Points per Month', 'price'=>10]
        $db = PlanProduct::create(
            ['region'=>'au', 'title'=>'SILVER', 'description'=>'5000 Points per Month']
        );
        dd($db);

        // $db = PlanProduct::firstOrCreate(['region'=>'us']);
        // dd($db);

        // $db = PlanProduct::firstOrNew(['region'=>'ca']);
        // $bool = $db->save();
        // dd($db);

        /* 修改 */
        // $db=PlanProduct::find(37);
        // $db->price = 15;
        // $bool = $db->save();
        // dd($bool);

        // $num=PlanProduct::where('title','=','SILVER')->update(['price'=>1]);
        // dd($num);

        /* 删除 */
        // $db=PlanProduct::find(37);
        // $bool = $db->delete();
        // dd($bool);

        // $num=PlanProduct::destroy(38);
        // dd($num);

        // $num=PlanProduct::destroy([31, 35]);
        // dd($num);

    }

    // https://blog.csdn.net/zls986992484/article/details/52824962

}