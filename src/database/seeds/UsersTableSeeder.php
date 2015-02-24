<?php
use Illuminate\Database\Seeder;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;





class UsersTableSeeder extends Seeder {


	public function __construct(Registrar $registrar)
	{
		$this->registrar = $registrar;

	}

  public function run()
  {
    DB::table('users')->delete();
    DB::table('role_user')->delete();

    $user = $this->registrar->create([
    	'name' => 'Devel User',
    	'email' => 'devel@example.com',
    	'password' => 'develuser'
    ]);
    $user->roles()->attach(1);

    $faker = Faker\Factory::create();

    for($i = 0; $i < 10; $i++){
    	$user = $this->registrar->create([
    		'name' => $faker->name,
     		'email' => $faker->email,
     		'password' => $faker->word
     	]);

    }
  }
}
