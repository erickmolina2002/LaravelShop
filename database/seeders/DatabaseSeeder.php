<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AddressSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
        ]);
        DB::unprepared('REFRESH MATERIALIZED VIEW sales_commission_view');
    }
}
