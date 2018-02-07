<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->truncate();

        $position = Position::where('name', 'CEO')->first();
        DB::table('employees')->insert([
            'first_name' => 'Bill',
            'second_name' => 'Gates',
            'salary' => 10000000,
            'position_id' => $position->id,
        ]);
    }
}
