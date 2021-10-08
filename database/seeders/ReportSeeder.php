<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::factory()
            ->count(25)
            ->create();
    }
}
