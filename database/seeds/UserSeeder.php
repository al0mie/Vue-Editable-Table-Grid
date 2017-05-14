<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username'   => $faker->userName,
                'email'      => $faker->safeEmail,
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'address'    => $faker->address,
            ];
        }

        $this->insert('users', $data);
    }
}
