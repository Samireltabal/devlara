<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Shifts;

class InstallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('password'),
            'locale' => 'en',
            'created_at' => Carbon::now(),
            'active' => 1
        ]);
        DB::table('roles')->insert([
        [
            'id' => 1,
            'name' => 'admin',
            'created_at' => Carbon::now(),
            'description' => 'Super admin privilege can edit anything'
        ],
        [
            'id' => 2,
            'name' => 'employee',
            'created_at' => Carbon::now(),
            'description' => 'can sell and edit his profile'
        ]
        ]);
        DB::table('role_user')->insert([
            'id' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'user_id' => 1
        ]);
        DB::table('options')->insert([
            [
                'id' => 1,
                'key' => 'locale',
                'created_at' => Carbon::now(),
                'value' => 'en'
            ],
            [
            'id' => 2,
            'key' => 'direction',
            'created_at' => Carbon::now(),
            'value' => 'rtl'
            ]
        ]);
        DB::table('inventories_types')->insert([[
            'id' => 1,
            'created_at' => Carbon::now(),
            'name' => 'Sell'            
            
        ],[
            'id' => 2,
            'created_at' => Carbon::now(),
            'name' => 'Buy'            
        ],[
            'id' => 3,
            'created_at' => Carbon::now(),
            'name' => 'Return'            
        ]]);
        $shift = new Shifts;
        $shift->year = Carbon::today()->year;
        $shift->month = Carbon::today()->month;
        $shift->day = Carbon::today()->day;
        $shift->active = 1;
        $shift->created_by = 1;    
        $shift->save();
    }
}
