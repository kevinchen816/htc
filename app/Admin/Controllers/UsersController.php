<?php

namespace App\Admin\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
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
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->name('Name');
        $grid->email('Email');
        $grid->password('Password');
        $grid->confirmed('Confirmed');
        // $grid->stripe_id('Stripe id');
        // $grid->card_brand('Card brand');
        // $grid->card_last_four('Card last four');
        // $grid->trial_ends_at('Trial ends at');
        // $grid->subscription_ends_at('Subscription ends at');
        $grid->date_format('Date format');
        $grid->portal('Portal');
        $grid->permission('Permission');
        $grid->sel_menu('Sel menu');
        $grid->sel_camera('Sel camera');
        $grid->sel_camera_tab('Sel camera tab');
        $grid->sel_account_tab('Sel account tab');
        $grid->remember_token('Remember token');
        $grid->email_verified('Email verified');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
            $actions->disableEdit();
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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->email('Email');
        $show->password('Password');
        $show->confirmed('Confirmed');
        $show->stripe_id('Stripe id');
        $show->card_brand('Card brand');
        $show->card_last_four('Card last four');
        $show->trial_ends_at('Trial ends at');
        $show->subscription_ends_at('Subscription ends at');
        $show->date_format('Date format');
        $show->portal('Portal');
        $show->permission('Permission');
        $show->sel_menu('Sel menu');
        $show->sel_camera('Sel camera');
        $show->sel_camera_tab('Sel camera tab');
        $show->sel_account_tab('Sel account tab');
        $show->remember_token('Remember token');
        $show->email_verified('Email verified');
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
        $form = new Form(new User);

        $form->text('name', 'Name');
        $form->email('email', 'Email');
        $form->password('password', 'Password');
        $form->text('confirmed', 'Confirmed')->default('No');
        $form->text('stripe_id', 'Stripe id');
        $form->text('card_brand', 'Card brand');
        $form->text('card_last_four', 'Card last four');
        $form->datetime('trial_ends_at', 'Trial ends at')->default(date('Y-m-d H:i:s'));
        $form->datetime('subscription_ends_at', 'Subscription ends at')->default(date('Y-m-d H:i:s'));
        $form->text('date_format', 'Date format')->default('Y/m/d H:i:s');
        $form->number('portal', 'Portal');
        $form->number('permission', 'Permission');
        $form->text('sel_menu', 'Sel menu')->default('plan');
        $form->number('sel_camera', 'Sel camera');
        $form->text('sel_camera_tab', 'Sel camera tab')->default('overview');
        $form->text('sel_account_tab', 'Sel account tab')->default('plans');
        $form->text('remember_token', 'Remember token');
        $form->switch('email_verified', 'Email verified');

        return $form;
    }
}
