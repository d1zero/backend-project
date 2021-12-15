<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moderator = new Role();
        $moderator->name = 'moderator';
        $moderator->save();

        $reader = new Role();
        $reader->name = 'reader';
        $reader->save();
    }
}
