<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Events\Registered;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roleSuper = Role::create([
            'name' => 'Super admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Permission::create([
            'name' => 'create user',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Permission::create([
            'name' => 'create role',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Permission::create([
            'name' => 'create permission',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $roleSuper->givePermissionTo('create user');
        $roleSuper->givePermissionTo('create permission');
        $roleSuper->givePermissionTo('create role');

        $roleAdmin->givePermissionTo('create user');

        $superAdmin = User::create([
            'name' => 'Superadmin akun',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $superAdmin->assignRole('Super admin');
        event(new Registered($superAdmin));

        $admin = User::create([
            'name' => 'admin akun',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole('Admin');
        event(new Registered($admin));
    }
}
