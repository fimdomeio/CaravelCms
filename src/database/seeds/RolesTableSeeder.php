<?php
use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        \App\Role::create(['name' => 'admin']);
        \App\Role::create(['name' => 'editor']);
    }

}