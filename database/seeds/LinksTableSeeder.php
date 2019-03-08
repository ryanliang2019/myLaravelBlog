<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/*
        DB::table('links')->insert([
            'link_name' => Str::random(5),
            'link_title' => Str::random(10),
            'link_url' => Str::random(15),
            'link_order' => 0,
        ]);
		*/

		/*
		$data = [
			[
				'link_name' => 'Laravel Documentation',
				'link_title'=> 'Laravel 5.7 Documentation',
				'link_url'	=> 'https://laravel.com/docs/5.7',
				'link_order'=> 0,
			],
			[
				'link_name' => 'Laravel Documentation (Chinese)',
				'link_title'=> 'Laravel 5.2 Documentation (Cinese)',
				'link_url'  => 'https://laravelacademy.org/category/laravel-5_2',
				'link_order'=> 1,
			],
			[
                'link_name' => 'Laravel Framework Resource (Chinese)',
                'link_title'=> 'Another Laravel (Cinese)',
                'link_url'  => 'https://www.golaravel.com/',
                'link_order'=> 2,
            ],
		];
		DB::table('links')->insert($data);
		*/
    }
}
