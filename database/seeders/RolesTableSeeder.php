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


        $adminRole = Role::create(['name' => 'admin', 'display_name_en' => 'Administrator', 'description_en' => 'System Administrator', 'display_name' => 'الإدارة', 'description' => 'مدير النظام', 'allowed_route' => 'admin']);
        $editorRole = Role::create(['name' => 'editor', 'display_name_en' => 'Supervisor', 'description_en' => 'System Supervisor', 'display_name' => 'مشرف', 'description' => 'مشرف النظام', 'allowed_route' => 'admin']);
        $userRole = Role::create(['name' => 'user', 'display_name_en' => 'User', 'description_en' => 'Normal User', 'display_name' => 'مستخدم', 'description' => 'مستخدم عادي', 'allowed_route' => null]);

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@suwayyed-blog.com',
            'mobile' => '962781860708',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12341234'),
            'status' => 1,
        ]);
        $admin->attachRole($adminRole);


        $editor = User::create([
            'name' => 'Editor',
            'username' => 'editor',
            'email' => 'editor@bloggi.test',
            'mobile' => '96278888811',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123123123'),
            'status' => 1,
        ]);
        $editor->attachRole($editorRole);


        $user1 = User::create(['name' => 'Rami Suwayyed', 'username' => 'rami96', 'email' => 'Rami.Suwayyed@suwayyed-blog.com', 'mobile' => '962781860702', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('123123123'), 'status' => 1,]);
        $user1->attachRole($userRole);

        $user2 = User::create(['name' => 'Ahmad Suwayyed', 'username' => 'ahmad92', 'email' => 'Ahmad.Suwayyed@suwayyed-blog.com', 'mobile' => '962788716641', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('123123123'), 'status' => 1,]);
        $user2->attachRole($userRole);

        $user3 = User::create(['name' => 'Mohammad Suwayyed', 'username' => 'mohammad99', 'email' => 'Mohammad.Suwayyed@suwayyed-blog.com', 'mobile' => '9621817654', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('123123123'), 'status' => 1,]);
        $user3->attachRole($userRole);

        for ($i = 0; $i <10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'mobile' => '9627' . random_int(10000000, 99999999),
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('1234512345'),
                'status' => 1
            ]);
            $user->attachRole($userRole);
        }


    }
}
