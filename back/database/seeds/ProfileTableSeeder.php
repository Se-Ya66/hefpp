<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'prefecture' => '愛知',
            'type' => '加工',
            'url' => 'https://www.google.com',
            'introduction' => 'テストテスト',
            'address' => '愛知県名古屋市',
            'tel' => 000-000-000,
            'user_id' => 1,
        ]);
    }
}
