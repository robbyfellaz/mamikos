<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kosts')->insert([
            'name' => 'Kos Jakarta',
            'description' => 'Kos di daerah Jakarta',
            'price' => 1500000,
            'location' => 'Jakarta',
            'available_room' => 20,
            'booked_room' => 0,
            'image' => 'https://via.placeholder.com/300x200',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('kosts')->insert([
            'name' => 'Kos Surabaya',
            'description' => 'Kos di daerah Surabaya',
            'price' => 1000000,
            'location' => 'Surabaya',
            'available_room' => 40,
            'booked_room' => 0,
            'image' => 'https://via.placeholder.com/300x200',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('kosts')->insert([
            'name' => 'Kos Yogyakarta',
            'description' => 'Kos di daerah Yogyakarta',
            'price' => 500000,
            'location' => 'Yogyakarta',
            'available_room' => 10,
            'booked_room' => 0,
            'image' => 'https://via.placeholder.com/300x200',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('kosts')->insert([
            'name' => 'Kos Malang',
            'description' => 'Kos di daerah Malang',
            'price' => 300000,
            'location' => 'Malang',
            'available_room' => 50,
            'booked_room' => 0,
            'image' => 'https://via.placeholder.com/300x200',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
