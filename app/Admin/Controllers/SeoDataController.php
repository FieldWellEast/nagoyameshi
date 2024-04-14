<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SeoData;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeoDataController extends AdminController
{
    use HasResourceActions;

    protected function grid()
    {
        $grid = new Grid(new SeoData());

        // グリッドの列を設定
        $grid->column('id', 'ID');
        $grid->column('page_name', 'ページ名');
        $grid->column('title', 'タイトル');
        $grid->column('description', '説明');
        // 必要に応じて他の列を追加

        return $grid;
    }

    public function create(Content $content)
    {
        return $content
            ->title('Create SEO Data')
            ->description('Description')
            ->body($this->form());
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title('Edit SEO Data')
            ->description('Description')
            ->body($this->form()->edit($id));
    }

    protected function form()
    {
        $form = new Form(new SeoData());

        $form->text('page_name', 'ページ名');
        $form->text('title', 'タイトル');
        $form->textarea('description', '説明');

        return $form;
    }


    public function store()
    {
        return parent::store();
    }

    public function update($id)
    {
        return parent::update($id);
    }

    public function destroy($id)
    {
        // データを削除して、インデックスページにリダイレクト
        $seoData = SeoData::findOrFail($id);
        $seoData->delete();
        return redirect()->route('admin.seo.index')->with('success', 'SEOデータが正常に削除されました。');
    }
}
