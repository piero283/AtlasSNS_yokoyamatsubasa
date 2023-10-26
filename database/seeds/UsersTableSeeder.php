<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usersテーブルに初期レコードの追加
        DB::table('users')->insert([
            ['username' => 'null','mail' => 'null','password' => bcrypt('null'),]
        ]);
    }
}
