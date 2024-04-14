<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionAgreement;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Form;

class SubscriptionAgreementController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Subscription Agreements');
            $content->description('List of subscription agreements');
            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        $grid = new \Encore\Admin\Grid(new SubscriptionAgreement);

        $grid->disableCreateButton(); // 新規作成ボタンを非表示
        $grid->actions(function ($actions) {
            $actions->disableDelete(); // 削除ボタンを非表示
        });

        $grid->column('id', 'ID');
        $grid->column('content', 'Content');
        // $grid->column('content', 'Content')->display(function ($content) {
        //     return strip_tags(Str::limit($content, 50));
        // }); 
        $grid->column('created_at', 'Created At');
        $grid->column('updated_at', 'Updated At');

        return $grid;
    }

    // 会員規約の表示
    public function show()
    {
        $subscriptionAgreement = SubscriptionAgreement::latest()->first();
        return view('user.subscription_agreement', ['subscriptionAgreement' => $subscriptionAgreement]);
    }
    
    // 会員規約の編集フォームを表示
    public function edit($id, Content $content)
    {
        $agreement = SubscriptionAgreement::findOrFail($id);

        $form = new Form($agreement); 

        $form->model($agreement);

        $form->method('PUT');

        $form->action(route(config('admin.route.prefix') . '.subscription_agreements.update', ['id' => $id]));

        $form->textarea('content', 'Content')->rules('required|string')->default($agreement->content);

        return $content
            ->header('Subscription Agreement編集')
            ->description('Edit the subscription agreement')
            ->body($form->edit($id));
    }
        
    protected function form($agreement)
    {
        $form = new Form();
        
        // テキストエリアフィールドを追加し、コンテンツを表示する
        $form->textarea('content', __('Content'))->rules('required')->default($agreement->content);
        
        return $form;
    }

    public function update($id, Request $request)
    {
        $agreement = SubscriptionAgreement::findOrFail($id);
        $agreement->content = $request->input('content');
        $agreement->save();

        return redirect()->route(config('admin.route.prefix') . '.subscription_agreements.index')
                        ->with('success', 'Subscription Agreement successfully updated.');
    }


    public function store(Request $request)
    {
        // 何も追加しない
    }
    
}