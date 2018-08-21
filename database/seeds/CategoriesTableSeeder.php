<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Entertainment'],
            ['name' => 'Comedy'],
            ['name' => 'Social gathering'],
            ['name' => 'Sports']
        ];

        foreach($categories as $key => $value)
            Category::create($value);
    }
}
