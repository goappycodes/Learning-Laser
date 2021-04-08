<?php

use Illuminate\Database\Seeder;

class EntitledLeavesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records=[
            [
                'leave_name' => 'Casual Leave',
                'no_of_days' => 21,
                'period' => 'Annual',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'leave_name' => 'Medical Leave',
                'no_of_days' => 10,
                'period' => 'Annual',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        foreach ($records as $record) {
           DB::table('entitled_leaves')->insert($record);
        }
    }
}
