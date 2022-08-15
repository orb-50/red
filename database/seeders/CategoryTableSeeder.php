<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                "category"=>"なし",
            ],
            [
                "category"=>"プライベート",
            ],
            [
                "category"=>"職務",
            ],
            [
                "category"=>"勉強",
            ],
            
        ]);
    }
}
