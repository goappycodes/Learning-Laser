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
        DB::table('users')->truncate();
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
                'entitlements' => '[1,2]',
                'joining_date' => '2016-03-26',
                'gender' => 1,
                'dob' => '1990-08-03',
                'ph_no' => 1231231231,
                'local_address' => 'Sydney, Australia',
                'permanent_address' => 'Sydney, Australia',
                'remember_token' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'country_id' => 1
            ],
            [
                'f_name' => 'Sam',
                'l_name' => 'Williams',
                'email' => 'sam@email.com',
                'employee_id' => 'EMP-1234',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('admin!'),
                'role_id' => 2,
                'department_id' => 1,
                'designation_id' => 1,
                'entitlements' => '[1,2]',
                'joining_date' => '2016-03-26',
                'gender' => 1,
                'dob' => '1990-08-03',
                'ph_no' => 1231231231,
                'local_address' => 'Sydney, Australia',
                'permanent_address' => 'Sydney, Australia',
                'remember_token' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'country_id' => 2
            ],
            [
                'f_name' => 'Self',
                'l_name' => 'Employed',
                'email' => 'self@email.com',
                'employee_id' => 'EMP-123467',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('admin!'),
                'role_id' => 2,
                'department_id' => 1,
                'designation_id' => 1,
                'entitlements' => '[1,2]',
                'joining_date' => '2016-03-26',
                'gender' => 1,
                'dob' => '1990-08-03',
                'ph_no' => 1231231231,
                'local_address' => 'Sydney, Australia',
                'permanent_address' => 'Sydney, Australia',
                'remember_token' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'country_id' => 3
            ]
        ];
        foreach ($records as $record) {
           DB::table('users')->insert($record);
        }
    }
}
