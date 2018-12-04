<?php

namespace App\Admin\Controllers;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PlansController extends Controller
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
            ->header('Index')
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
    // public function show($id, Content $content)
    // {
    //     return $content
    //         ->header('Detail')
    //         ->description('description')
    //         ->body($this->detail($id));
    // }

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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Plan);

        $grid->id('ID');
        $grid->iccid('ICCID');
        $grid->region('Region');
        $grid->user_id('User ID');
        $grid->camera_id('Camera ID');
        $grid->style('Style');
        $grid->status('Status');

        // $grid->bill_points('Bill points');
        // $grid->bill_month('Bill month');
        // $grid->bill_price('Bill price');
        // $grid->bill_begin('Bill begin');
        // $grid->bill_end('Bill end');
        // $grid->auto_bill('Auto Bill');
        // $grid->auto_reserve('Auto Reserve');
        // $grid->date_renew('Date Renew');
        // $grid->date_bill('Date Bill');

        $grid->points('Points');
        $grid->points_used('Points Used');
        $grid->sms('SMS');
        $grid->sms_sent('SMS Sent');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        // $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
            // $actions->disableEdit();
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
        $show = new Show(Plan::findOrFail($id));

        $show->id('ID');
        $show->iccid('ICCID');
        $show->region('Region');
        $show->user_id('User ID');
        $show->camera_id('Camera ID');
        $show->style('Style');
        $show->status('Status');
        // $show->bill_points('Bill points');
        // $show->bill_month('Bill month');
        // $show->bill_price('Bill price');
        // $show->bill_begin('Bill begin');
        // $show->bill_end('Bill end');
        // $show->auto_bill('Auto Bill');
        // $show->auto_reserve('Auto Reserve');
        // $show->date_renew('Date Renew');
        // $show->date_bill('Date Bill');
        $show->points('Points');
        $show->points_used('Points Used');
        $show->sms('SMS');
        $show->sms_sent('SMS Sent');
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
        $form = new Form(new Plan);

        $form->text('iccid', 'ICCID');
        $form->text('Region');
        $form->number('user_id', 'User ID');
        $form->number('camera_id', 'Camera ID');
        $form->text('style', 'Style');

        // $form->text('status', 'Status');
        $form->radio('status', 'Status')
             ->options(['suspend' => 'Suspend', 'active'=> 'Active'])
             ->default('suspend');

        // $form->number('bill_points', 'Bill points');
        // $form->number('bill_month', 'Bill month')->default(1);
        // $form->decimal('bill_price', 'Bill price')->default(0.00);
        // $form->date('bill_begin', 'Bill begin')->default(date('Y-m-d'));
        // $form->date('bill_end', 'Bill end')->default(date('Y-m-d'));
        // $form->number('auto_bill', 'Auto Bill');
        // $form->number('auto_reserve', 'Auto Reserve');
        // $form->date('date_renew', 'Date Renew')->default(date('Y-m-d'));
        // $form->date('date_bill', 'Date Bill')->default(date('Y-m-d'));
        $form->decimal('points', 'Points')->default(0.00);
        $form->decimal('points_used', 'Points Used')->default(0.00);
        $form->number('sms', 'SMS');
        $form->number('sms_sent', 'SMS Sent');

        return $form;
    }
}
