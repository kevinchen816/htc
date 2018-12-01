<?php

namespace App\Admin\Controllers;

use App\Models\PlanProduct;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

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
}
