<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Talk;


class TalksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i < 20;$i++)
        {
            $count = User::count();
            $user_id = rand(1, $count);
            factory(Talk::class)->create([
                'user_id' => $user_id,
            ]);
        }
    }
}
