<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moderator = Role::where('name', 'moderator')->value('id');
        $reader = Role::where('name', 'reader')->value('id');

        $user1 = new User();
        $user1->name = 'd1zero';
        $user1->email = 'admin@admin.admin';
        $user1->password = Hash::make(123456);
        $user1->role_id = $moderator;
        $user1->save();

        $user1 = new User();
        $user1->name = 'd1zero2';
        $user1->email = 'admin2@admin.admin';
        $user1->password = Hash::make(123456);
        $user1->role_id = $reader;
        $user1->save();
    }
}
