<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id' => '1','name' => '后台管理员','email' => 'admin@qdefense.cn','password' => '$2y$10$ZmxNRfpc3gH3DHzPRXgLS.13DBm6brS9XMMt9x7C.s/FjEGVxfBcS','remember_token'=>'o6KGm8z4K0Gvg8oXb34hw8rjVk92uCto7jucw9YVOdy67OKRglwjyyV1oGPY','created_at'=>'2016-06-20 09:52:13','updated_at'=>'2016-06-20 09:52:13'],
            ['id' => '2','name' => '一般管理员','email' => 'test@qdefense.cn','password' => '$2y$10$ZmxNRfpc3gH3DHzPRXgLS.13DBm6brS9XMMt9x7C.s/FjEGVxfBcS','remember_token'=>'o6KGm8z4K0Gvg8oXb34hw8rjVk92uCto7jucw9YVOdy67OKRglwjyyV1oGPY','created_at'=>'2016-06-20 09:52:13','updated_at'=>'2016-06-20 09:52:13'],
        ]);
        
    }
}
