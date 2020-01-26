<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('sidebar.menu') as $key => $menu) {
            if (!empty($menu['sub_menu'])) {
                DB::table('permissions')->insert([
                    'name' => strtolower($menu['title']),
                    'guard_name' => "web",
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                foreach ($menu['sub_menu'] as $key => $sub) {
                    DB::table('permissions')->insert([
                        'name' => substr($sub['url'], 1),
                        'guard_name' => "web",
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                }
            }else{
                DB::table('permissions')->insert([
                    'name' => substr($menu['url'], 1),
                    'guard_name' => "web",
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
