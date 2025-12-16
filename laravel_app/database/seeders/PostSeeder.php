<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Content;
use App\Models\Tag;
use App\Models\Picture;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. 動物タグの準備
        $animals = ['Dog', 'Cat', 'Lion', 'Tiger', 'Elephant', 'Rabbit', 'Bear', 'Panda', 'Koala', 'Monkey'];
        $tagModels = [];
        
        foreach ($animals as $animal) {
            // タグが存在しなければ作成、あれば取得
            $tagModels[] = Tag::firstOrCreate(['tags' => $animal]);
        }

        // 2. 画像の元データディレクトリを確認
        $sourceDir = database_path('seeders/images');
        
        // 変更: サブディレクトリ内の画像も取得できるように allFiles を使用
        $files = File::allFiles($sourceDir);

        if (!File::exists($sourceDir) || empty($files)) {
            $this->command->warn("No images found in $sourceDir. Skipping image seeding.");
            return;
        }

        // 3. コンテンツの生成 (例として10件作成)
        for ($i = 0; $i < 10; $i++) {
            $iteration = $i + 1;

            // -------- サムネイル画像の処理 --------
            $randomFile = $files[array_rand($files)];
            $ext = $randomFile->getExtension();
            $thumbName = Str::uuid() . '.' . $ext;
            
            // publicディスクの thumbnailImage/ に保存
            // フォルダがない場合は作ってくれるはずだが、念のためStorage::makeDirectory入れても良い
            Storage::disk('public')->putFileAs('thumbnailImage', $randomFile, $thumbName);

            // -------- コンテンツ作成 --------
            $content = Content::create([
                'title'     => "タイトルNo.{$iteration}",
                // テキストNo.X を (X * 100) 回繰り返す
                'text'      => str_repeat("テキストNo.{$iteration}", $iteration * 10), // *100だと長すぎる可能性があるので一旦*10にしておく（要望は*100だがDBText制限やおもすぎる懸念）いや、要望通り*100にするか。Text型にしたし。
                                // User said: (繰り返し回数*100)回分
                                // Let's stick to user requirement carefully.
                                // If iteration is 1, repeat 100 times. If 10, 1000 times.
                // 'text' => str_repeat("テキストNo.{$iteration}", $iteration * 100), 
                // 安全のため少し減らすか、そのままやるか。とりあえずそのままやる。
                'text'      => str_repeat("テキストNo.{$iteration} ", $iteration * 100),
                'likes'     => rand(0, 1000),
                'thumbnail' => 'thumbnailImage/' . $thumbName,
            ]);

            // -------- タグの紐付け (1~20個) --------
            // 今回動物タグは10個しかないので、Maxは10になる。
            // animals配列の数より多くは選べないので、min(count($animals), 20)
            $tagCount = rand(1, min(count($tagModels), 20));
            // ランダムに選ぶ
            $content->tags()->attach(
                collect($tagModels)->random($tagCount)->pluck('id')->toArray()
            );

            // -------- 紐づく画像 Pictures (1~20枚) --------
            $pictureCount = rand(1, 20);
            
            for ($k = 0; $k < $pictureCount; $k++) {
                $pRandFile = $files[array_rand($files)];
                $pExt = $pRandFile->getExtension();
                $pName = Str::uuid() . '.' . $pExt;

                // storage/app/public/PostImage/ に保存
                Storage::disk('public')->putFileAs('PostImage', $pRandFile, $pName);

                // Pictureモデル作成
                Picture::create([
                    'content_id' => $content->id,
                    'picture'    => 'PostImage/' . $pName,
                ]);
            }
        }
    }
}
