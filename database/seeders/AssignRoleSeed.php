<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::find(5);
        $user = User::find(6);

        $adminRole = Role::where('name', '=', 'admin')->first();
        $userRole = Role::where('name', '=', 'user')->first();

        $user->assignRole($userRole);
        $adminUser->assignRole($adminRole);
    }
}
