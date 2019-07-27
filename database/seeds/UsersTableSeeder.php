<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'name' => 'Phước Trung',
            'email' => 'trungkenbi@hotmail.com',
            'password' => bcrypt('23456789'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
