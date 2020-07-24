<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 8; $i++)
        {
            $param = [
                'user_id' => $i + 2,
                'profile' => Inspiring::quote(),
                'icon' => 'icons/icon (' . $i . ').png',
            ];
            DB::table('people')->insert($param);
        }
    }
}
