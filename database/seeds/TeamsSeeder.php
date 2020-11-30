<?php

use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert  // not working
        ([
            'user_id'=>'1',
            'user_pok'=>'1',
        ],
        [
            'user_id'=>'1',
            'user_pok'=>'2',
        ]);

    }
}
