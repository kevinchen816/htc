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
            ->header('商品列表') // Index
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
            ->header('创建商品') // Create
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

        $grid->id('Id');
        $grid->region('Region');
        $grid->title('商品名称');   // Title
        $grid->description('Description');
        $grid->image('Image');
        // $grid->on_sale('On sale');
        $grid->on_sale('已上架')->display(function ($value) {
            return $value ? '是' : '否';
        });

        $grid->rating('评分'); // Rating
        $grid->sold_count('销量'); // Sold count
        $grid->price('价格'); // Price
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

        $show->id('Id');
        $show->region('Region');
        $show->title('Title');
        $show->description('Description');
        $show->image('Image');
        $show->on_sale('On sale');
        $show->rating('Rating');
        $show->sold_count('Sold count');
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
        $form->text('description', 'Description');
        // $form->image('image', 'Image'); // $ php artisan storage:link

        // $form->switch('on_sale', 'On sale')->default(1);
        $form->radio('on_sale', 'On Sale')
             ->options(['1' => 'Yes', '0'=> 'No'])
             ->default('0');

        // $form->decimal('rating', 'Rating')->default(5.00);
        // $form->number('sold_count', 'Sold count');
        // $form->decimal('price', 'Price');

        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
            $form->text('title', 'SKU 名称')->rules('required');
            $form->text('description', 'SKU 描述'); //->rules('required');
            $form->text('price', '单价')->rules('required|numeric|min:0.01');
            // $form->text('stock', '剩余库存')->rules('required|integer|min:0');
            $form->radio('on_sale', 'On Sale')
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

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'SILVER', 'description'=>'5000 Points per Month', 'price'=>10]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'title'=>'12.95 per Month [cpp: 0.00259]', 'price'=>12.95],
            ['plan_product_id'=>$id, 'title'=>'36.95 for 3 Months [cpp: 0.00246]', 'price'=>36.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'GOLD', 'description'=>'5000 Points per Month', 'price'=>10]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'title'=>'19.95 per Month [cpp: 0.00200]', 'price'=>19.95],
            ['plan_product_id'=>$id, 'title'=>'57.95 for 3 Months [cpp: 0.00193]', 'price'=>57.95],
        ]);

        $id = DB::table("plan_products")->insertGetId(
            ['region'=>'au', 'title'=>'PLATINUM PRO', 'description'=>'5000 Points per Month', 'price'=>10]
        );
        DB::table('plan_product_skus')->insert([
            ['plan_product_id'=>$id, 'title'=>'26.95 per Month [cpp: 0.00135]', 'price'=>26.95],
            ['plan_product_id'=>$id, 'title'=>'77.95 for 3 Months [cpp: 0.00130]', 'price'=>77.95],
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
