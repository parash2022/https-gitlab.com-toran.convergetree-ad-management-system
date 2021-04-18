<?php

use Illuminate\Database\Seeder;
use App\Term;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed administrator
        $user = Term::create([
            'taxonomy_id' => '1',
            'term_id' => NULL,
            'name' => 'Uncategorized',
            'slug'  => 'uncategorized'
        ]);

    }
}
