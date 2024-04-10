<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Form; 
use App\Models\Company;
use Encore\Admin\Grid\Displayers\Actions;

class CompanyController extends AdminController
{
    // 会社情報の一覧表示
    public function index(Content $content)
    {
        return $content
            ->title('Companies')
            ->body($this->grid());
    }

    // 会社情報の一覧表示用のグリッドを生成
    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->column('id', __('ID'));
        $grid->column('company_name', __('Company Name'));
        $grid->column('ceo', __('Ceo'));
        $grid->column('establishment', __('Establishment'));
        $grid->column('post_code', __('Post Code'));
        $grid->column('address', __('Address'));
        $grid->column('business', __('Business'));

         // アクションを設定
         $grid->actions(function (Actions $actions) {
            // Deleteアクションを非表示にする
            $actions->disableDelete();
        });

        return $grid;
    }

    // 会社情報の詳細表示
    public function show($id, \Encore\Admin\Layout\Content $content)
{
    return $content
        ->title('Company Detail')
        ->body($this->detail($id));
}

protected function detail($id)
{
    $show = new Show(Company::findOrFail($id));

    $show->field('id', __('ID'));
    $show->field('company_name', __('Company Name'));
    $show->field('ceo', __('Ceo'));
    $show->field('establishment', __('Establishment'));
    $show->field('post_code', __('Post Code'));
    $show->field('address', __('Address'));
    $show->field('business', __('Business'));

    return $show;
}

    // 会社情報の作成と更新
    public function form()
    {
        $form = new Form(new Company());

        $form->text('company_name', __('Company Name'));
        $form->text('ceo', __('Ceo'));
        $form->date('establishment', __('Establishment'));
        $form->text('post_code', __('Post Code'));
        $form->text('address', __('Address'));
        $form->text('business', __('Business'));

        return $form;
    }


}

