<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

        $roles_admin= new Role();
        $roles_admin->setTranslation('name', 'en', 'admin')
            ->setTranslation('name', 'ar', 'ادمن')
            ->save();

        $roles_editor= new Role();
        $roles_editor->setTranslation('name', 'en', 'Editor')
            ->setTranslation('name', 'ar', 'محرر')
            ->save();
        $roles= new Role();
        $roles->setTranslation('name', 'en', 'User')
            ->setTranslation('name', 'ar', 'مستخدم')
            ->save();

        $permissions =Permission::get();
        foreach ($permissions as $permission){
            DB::table('role_permission')->insert(
                ['role_id' => $roles_admin->id, 'permission_id' => $permission->id]
            );
        }
        foreach ($permissions as $permission){
            DB::table('role_permission')->insert(
                ['role_id' => $roles_editor->id, 'permission_id' => $permission->id]
            );
        }


        $tmp_images = [
            public_path('assets/tmp/users/01.png'),
            public_path('assets/tmp/users/02.png'),
            public_path('assets/tmp/users/03.png'),
            public_path('assets/tmp/users/04.png'),
            public_path('assets/tmp/users/05.png'),
            public_path('assets/tmp/users/06.png'),
            public_path('assets/tmp/users/07.png'),
            public_path('assets/tmp/users/08.png'),
            public_path('assets/tmp/users/09.png'),
            public_path('assets/tmp/users/10.png'),
        ];




        $filename1 = Str::slug(Str::random(10)) .'.png';
        $path1 = public_path('/assets/users/' . $filename1);
        Image::make(Arr::random($tmp_images))->save($path1, 100);

        $admin =  User::create([
            'user_role' => 'admin',
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@bloggi.online',
            'email_verified_at' => Carbon::now(),
            'phone_number' => $faker->phoneNumber,
            'bio' => 'Admin User',
            'user_image' => $filename1,
            'receive_email' => 1,
            'password' =>  Hash::make('password'),
            'is_super_admin' => 1,
            'status' => 1,
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('role_user')->insert(
            ['role_id' => $roles_admin->id, 'user_id' => $admin->id]
        );


        $filename2 = Str::slug(Str::random(10)) .'.png';
        $path2 = public_path('/assets/users/' . $filename2);
        Image::make(Arr::random($tmp_images))->save($path2, 100);

        $editor = User::create([
            'user_role' => 'admin',
            'name' => 'Editor',
            'username' => 'editor',
            'email' => 'editor@bloggi.online',
            'email_verified_at' => Carbon::now(),
            'phone_number' => $faker->phoneNumber,
            'bio' => 'Editor User',
            'user_image' => $filename2,
            'receive_email' => 1,
            'password' =>  Hash::make('password'),
            'is_super_admin' => 0,
            'status' => 1,
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('role_user')->insert(
            ['role_id' => $roles_editor->id, 'user_id' => $editor->id]
        );

        $filename3 = Str::slug(Str::random(10)) .'.png';
        $path3 = public_path('/assets/users/' . $filename3);
        Image::make(Arr::random($tmp_images))->save($path3, 100);

        $user1 = User::create([
            'user_role' => 'user',
            'name' => 'Rami Suwayyed',
            'username' => 'rami96',
            'email' => 'Rami.Suwayyed@Bloggi.online',
            'email_verified_at' => Carbon::now(),
            'phone_number' => $faker->phoneNumber,
            'bio' => 'User',
            'user_image' => $filename3,
            'receive_email' => 1,
            'password' => bcrypt('123123123'),
            'is_super_admin' => 0,
            'status' => 1,
            ]);

        for ($i = 0; $i <10; $i++) {

            $filename = Str::slug(Str::random(10)) .'.png';
            $path = public_path('/assets/users/' . $filename);
            Image::make(Arr::random($tmp_images))->save($path, 100);

            $user = User::create([
                'user_role' => 'user',
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'email_verified_at' => Carbon::now(),
                'phone_number' => $faker->phoneNumber,
                'bio' => $faker->text,
                'user_image' => $filename,
                'receive_email' => 1,
                'password' => bcrypt('123123123'),
                'is_super_admin' => 0,
                'status' => 1,
            ]);
        }


    }
}
