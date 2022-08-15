<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "name"=>"小泉 明",
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"田辺 篤司",
                'email' => 'stuff@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'2',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"鈴木 里佳",
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"野村 涼平",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"宇野 さゆり",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"吉田 くみ子",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"西之園 太一",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"宮沢 明美",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"浜田 春香",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                "name"=>"加納 洋介",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'=>'3',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ]);
    }
}
