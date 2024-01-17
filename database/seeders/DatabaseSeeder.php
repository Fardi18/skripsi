<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table("admins")->insert([
            [
                "id" => 1,
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("password"),
            ]
        ]);
    }
}
