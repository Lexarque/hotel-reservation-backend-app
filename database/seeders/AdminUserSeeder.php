<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Domain\IAM\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Admin')->first();

        $user = User::updateOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        $user->assignRole($role);
    }
}
