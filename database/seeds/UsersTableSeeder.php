<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'f_name' => 'Anna',
                'l_name' => 'Nguen',
                'email' => 'anna@email.com',
                'employee_id' => 'EMP-123',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('admin!'),
                'role_id' => 1,
                'department_id' => 1,
                'designation_id' => 1,
                'joining_date' => '2016-03-26',
                'gender' => 1,
                'dob' => '1990-08-03',
                'ph_no' => 1231231231,
                'local_address' => 'Sydney, Australia',
                'permanent_address' => 'Sydney, Australia',
                'remember_token' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        foreach ($records as $record) {
           DB::table('users')->insert($record);
        }
    }
}
