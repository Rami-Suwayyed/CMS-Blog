<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();


        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'System Administrator', 'allowed_route' => 'admin']);
        $editorRole = Role::create(['name' => 'editor', 'display_name' => 'Supervisor', 'description' => 'System Supervisor', 'allowed_route' => 'admin']);
        $userRole = Role::create(['name' => 'user', 'display_name' => 'User', 'description' => 'Normal User', 'allowed_route' => null]);

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@bloggi.test',
            'mobile' => '962780800001',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);
        $admin->attachRole($adminRole);


        $editor = User::create([
            'name' => 'Editor',
            'username' => 'editor',
            'email' => 'editor@bloggi.test',
            'mobile' => '962780800002',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);
        $editor->attachRole($editorRole);


        $user1 = User::create(['name' => 'Rami Suwayyed', 'username' => 'Rami', 'email' => 'Rami@bloggi.test', 'mobile' => '962780800003', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('12345678'), 'status' => 1,]);
        $user1->attachRole($userRole);

        $user2 = User::create(['name' => 'Mahmoud Hassan', 'username' => 'mahmoud', 'email' => 'mahmoud@bloggi.test', 'mobile' => '962780800004', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('12345678'), 'status' => 1,]);
        $user2->attachRole($userRole);

        $user3 = User::create(['name' => 'Khaled Ali', 'username' => 'khaled', 'email' => 'khaled@bloggi.test', 'mobile' => '962780800005', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('12345678'), 'status' => 1,]);
        $user3->attachRole($userRole);

        for ($i = 0; $i <10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'mobile' => '9627' . random_int(18080000, 99999999),
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('12345678'),
                'status' => 1
            ]);
            $user->attachRole($userRole);
        }
    }
}
