<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("admins")->delete();
        $adminRecords = [
            [
                "id" => 1,
                "name" => "admin",
                "type" => "admin",
                "mobile" => "5434833832",
                "email" => "admin@admin.com",
                "password" => Hash::make("password"),
                "image" => "",
                "status" => 1,

            ],            [
                "id" => 2,
                "name" => "dev",
                "type" => "dev",
                "mobile" => "4434832872",
                "email" => "dev@dev.com",
                "password" => Hash::make("password"),
                "image" => "",
                "status" => 1,

            ],            [
                "id" => 3,
                "name" => "user",
                "type" => "user",
                "mobile" => "8434812832",
                "email" => "user@user.com",
                "password" => Hash::make("password"),
                "image" => "",
                "status" => 1,

            ]
        ];

        foreach($adminRecords as $record) {
            \App\Admin::create($record);
        }
    }
}
