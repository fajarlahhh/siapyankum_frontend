<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = array('administrator','user');
        $i = 1;
        foreach ($level as $lvl) {
            DB::table('roles')->insert([
                'id' => $i,
                'name' => $lvl,
                'guard_name' => "web",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $i++;
        }
    }
}
