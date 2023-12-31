<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        $author = new Role();
        $author->name = 'author';
        $author->save();

        $subscriber = new Role();
        $subscriber->name = 'subscriber';
        $subscriber->save();
    }
}
