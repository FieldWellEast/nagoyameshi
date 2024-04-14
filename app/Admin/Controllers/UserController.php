<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\User;
use Encore\Admin\Layout\Content;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
    
        $grid->column('id', 'ID');
        $grid->column('name', 'Name');
        $grid->column('phone_number', 'Phone Number');
        $grid->column('email', 'Email');
        $grid->column('created_at', 'Created At');
        $grid->column('updated_at', 'Updated At');
        $grid->column('paid_membership_start_date', 'Paid Membership Start Date');
        $grid->column('paid_membership_update_date', 'Paid Membership Update Date');
        $grid->column('paid_membership_cancel_date', 'Paid Membership Cancel Date');
        $grid->column('paid_membership', 'Paid Membership');
    
        // ユーザーの編集・削除ボタンを表示する
        $grid->actions(function ($actions) {
            // 編集ボタン
            $actions->append('<a href="' . route('admin.users.edit', $actions->getKey()) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>');

            // 削除ボタン
            $actions->append('<a href="' . route('admin.users.destroy', $actions->getKey()) . '" 
                data-method="delete" 
                data-confirm="' . trans('admin.delete_confirm') . '" 
                class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>');
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

        // ユーザー詳細の表示設定を行う

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        // ユーザー編集・新規作成フォームの表示設定を行う

        return $form;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'status'  => true,
            'message' => trans('admin.delete_succeeded'),
        ]);
    }

    /**
     * Display the specified resource for editing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Content $content)
    {
        $form = new Form(new User());

        $form->text('name', 'Name')->rules('required');
        $form->email('email', 'Email')->rules('required|email');
        $form->text('phone_number', 'Phone Number')->rules('required');
        // その他のフォームフィールドもここに追加してください

        return $content
            ->title($this->title())
            ->description('Edit user information')
            ->body($form->edit($id));
    }
}