<?php

namespace App\Admin\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('image', __('Image'))->image();
        $grid->column('name', __('Name'));
        $grid->column('category.name', __('Category Name'));
        $grid->column('description', __('Description'));
        $grid->column('price_upper', __('Price upper'))->sortable(); // プロパティ名を修正
        $grid->column('price_lower', __('Price lower'))->sortable(); // プロパティ名を修正
        $grid->column('start_time', __('Start time'));
        $grid->column('closings_time', __('Closings time'));
        $grid->column('post_code', __('Post code'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('regular_holiday', __('Regular holiday'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->like('price_upper', '上限金額'); // プロパティ名を修正
            $filter->between('price_lower', '下限金額'); // プロパティ名を修正
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
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
        // データベースからショップを取得
        $shop = Shop::findOrFail($id);

        $show = new Show($shop);

        $show->field('id', __('Id'));
        $show->field('image', __('Image'))->image();
        $show->field('name', __('Name'));
        $show->field('category.name', __('Category Name'));
        $show->field('description', __('Description'));
        $show->field('price_upper', __('Price upper')); // プロパティ名を修正
        $show->field('price_lower', __('Price lower')); // プロパティ名を修正
        $show->field('start_time', __('Start time'));
        $show->field('closings_time', __('Closings time'));
        $show->field('post_code', __('Post code'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('regular_holiday', __('Regular holiday'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form() {
        
    $form = new Form(new Shop());
    $form->image('image', __('Image'));
    $form->text('name', __('Name'));
    $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
    $form->text('description', __('Description'));
    $form->text('price_upper', __('Price Upper')); // プロパティ名を修正
    $form->text('price_lower', __('Price Lower')); // プロパティ名を修正
    $form->time('start_time', __('Start Time'));
    $form->time('closings_time', __('Closings Time'));
    $form->text('post_code', __('Post Code'));
    $form->text('address', __('Address'));
    $form->text('phone_number', __('Phone Number'));
    $form->text('regular_holiday', __('Regular Holiday'));
    $form->datetime('created_at', __('Created at'))->default(now());
    $form->datetime('updated_at', __('Updated at'))->default(now());

    return $form;
    }
}