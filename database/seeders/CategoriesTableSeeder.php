<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = [
            '日本料理','寿司・海鮮','うなぎ・あなご','天ぷら','とんかつ・揚げ物','焼鳥・串焼き・鶏料理','すき焼き','しゃぶしゃぶ','そば','うどん','ラーメン','お好み焼き・たこ焼き','おでん','洋食','フレンチ','イタリアン','ステーキ・鉄板焼','スペイン料理','ヨーロッパ料理','アメリカ料理','中華料理','韓国料理','カレー','焼肉','鍋','居酒屋','パン','スイーツ'
        ];

        // カテゴリーをテーブルに挿入
        foreach ($category_names as $name) {
            Category::create(['name' => $name]);
        }
    }
}