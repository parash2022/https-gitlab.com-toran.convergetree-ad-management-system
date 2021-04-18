<?php

use Illuminate\Database\Seeder;
use App\Taxonomy;

class TaxonomiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed administrator
        $user = Taxonomy::create([
            'name' => 'Category',
            'slug'  => 'category'
        ]);
    }
}
