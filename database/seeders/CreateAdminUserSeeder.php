<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        $user = User::create([
            'name' => 'userbiasa',
            'email' => 'userbiasa@gmail.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'user']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        $editor = User::create([
            'name' => 'dais',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::create(['name' => 'editor']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $editor->assignRole([$role->id]);
    }
}
