<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Category;
use App\Models\User;

class InsertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:InsertData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // カテゴリーデータの登録
        $category = Category::create([
            'name' => 'その他'
        ]);
        $category = Category::create([
            'name' => 'ロマンス'
        ]);
        $category = Category::create([
            'name' => 'アクション'
        ]);
        $category = Category::create([
            'name' => 'ホラー'
        ]);

        $user = User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'comment' => 'テストユーザー',
            'password' => 'password'
        ]);

        return 0;
    }
}
