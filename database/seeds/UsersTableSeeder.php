<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Userファクトリーで定義したテストユーザーを 10 作成
        factory(App\User::class, 10)->create();    
    }
}
