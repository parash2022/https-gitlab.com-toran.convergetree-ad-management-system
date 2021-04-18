<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Administrator','Moderator','Author','Subscriber'];
        foreach($roles as $role){
            Role::Create(['title'=>$role]);
        }

    }
}
