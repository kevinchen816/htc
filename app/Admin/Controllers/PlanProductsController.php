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
            $form->text('sub_id', 'Subscription ID');
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

    public function build() {
        // DB::table('plan_products')->insert([
        //     ['region'=>'au', 'title'=>'SILVER', 'description'=>'5000 Points per Month', 'price'=>10],
        //     ['region'=>'au', 'title'=>'GOLD', 'description'=>'10000 Points per Month', 'price'=>20],
        //     ['region'=>'au', 'title'=>'PLATINUM PRO', 'description'=>'20000 Points per Month', 'price'=>30],

        //     ['region'=>'us', 'title'=>'SILVER', 'description'=>'5000 Points per Month', 'price'=>10],
        //     ['region'=>'us', 'title'=>'GOLD', 'description'=>'10000 Points per Month', 'price'=>20],
        //     ['region'=>'us', 'title'=>'PLATINUM PRO', 'description'=>'20000 Points per Month', 'price'=>30],
        // ]);

        /* us, ca, eu, au, cn, tw */
        /* eu */
        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'eu', 'title'=>'BRONZE', 'points'=>2500, 'active'=>0]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'eu_2500_1m', 'month'=>1, 'active'=>1, 'price'=>8.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_2500_3m', 'month'=>3, 'active'=>1, 'price'=>24.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_2500_6m', 'month'=>6, 'active'=>1, 'price'=>48.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_2500_12m', 'month'=>12, 'active'=>0, 'price'=>96.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'eu', 'title'=>'SILVER', 'points'=>5000, 'active'=>1]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'eu_5000_1m', 'month'=>1, 'active'=>1, 'price'=>12.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_5000_3m', 'month'=>3, 'active'=>1, 'price'=>36.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_5000_6m', 'month'=>6, 'active'=>1, 'price'=>72.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_5000_12m', 'month'=>12, 'active'=>0, 'price'=>144.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'eu', 'title'=>'GOLD', 'points'=>10000, 'active'=>1]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'eu_10000_1m', 'month'=>1, 'active'=>1, 'price'=>19.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_10000_3m', 'month'=>3, 'active'=>1, 'price'=>57.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_10000_6m', 'month'=>6, 'active'=>1, 'price'=>114.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_10000_12m', 'month'=>12, 'active'=>0, 'price'=>228.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'eu', 'title'=>'PLATINUM PRO', 'points'=>20000, 'active'=>1]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'eu_20000_1m', 'month'=>1, 'active'=>1, 'price'=>26.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_20000_3m', 'month'=>3, 'active'=>1, 'price'=>77.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_20000_6m', 'month'=>6, 'active'=>1, 'price'=>155.95],
            ['plan_product_id'=>$id, 'sub_id'=>'eu_20000_12m', 'month'=>12, 'active'=>0, 'price'=>310.95],
        ]);

        /* au */
        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'BRONZE', 'points'=>2500, 'active'=>0]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'au_2500_1m', 'month'=>1, 'active'=>1, 'price'=>8.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_2500_3m', 'month'=>3, 'active'=>1, 'price'=>24.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_2500_6m', 'month'=>6, 'active'=>1, 'price'=>48.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_2500_12m', 'month'=>12, 'active'=>0, 'price'=>96.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'SILVER', 'points'=>5000, 'active'=>1]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'au_5000_1m', 'month'=>1, 'active'=>1, 'price'=>12.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_5000_3m', 'month'=>3, 'active'=>1, 'price'=>36.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_5000_6m', 'month'=>6, 'active'=>1, 'price'=>72.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_5000_12m', 'month'=>12, 'active'=>0, 'price'=>144.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'GOLD', 'points'=>10000, 'active'=>1]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'au_10000_1m', 'month'=>1, 'active'=>1, 'price'=>19.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_10000_3m', 'month'=>3, 'active'=>1, 'price'=>57.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_10000_6m', 'month'=>6, 'active'=>1, 'price'=>114.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_10000_12m', 'month'=>12, 'active'=>0, 'price'=>228.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'PLATINUM PRO', 'points'=>20000, 'active'=>1]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'sub_id'=>'au_20000_1m', 'month'=>1, 'active'=>1, 'price'=>26.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_20000_3m', 'month'=>3, 'active'=>1, 'price'=>77.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_20000_6m', 'month'=>6, 'active'=>1, 'price'=>155.95],
            ['plan_product_id'=>$id, 'sub_id'=>'au_20000_12m', 'month'=>12, 'active'=>0, 'price'=>310.95],
        ]);

        return 'build...OK';
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
            // ->whereRaw('price >= ? and region = ?', [20, 'au']) // 多个条件
            // ->orderBy('price','asc') // asc, desc
            ->get(); // 返回多条数据
            // ->first(); // 返回1条数据
        dd($db);

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
