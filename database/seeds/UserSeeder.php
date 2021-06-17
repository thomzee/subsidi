<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $password = 'admin';
        $adminRole = 'Administrator';
        $role = new \App\Models\Role();
        $adminRoleModel = $role->create([
            'name' => $adminRole,
            'slug' => \Illuminate\Support\Str::slug($adminRole)
        ]);
        $userData = \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'status' => 1,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]);
        $userData->roles()->attach($adminRoleModel->id, [
            'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
