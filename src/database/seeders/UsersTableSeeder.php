<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'test',
            'email' => 'test@gmail',
            'password' => 'password',
            'email_verified_at' => Carbon::now(),
        ];
        $User = new User;
        $User->fill($param)->save();

        $param = [
            'name' => 'test2',
            'email' => 'test2@gmail',
            'password' => 'password',
            'email_verified_at' => Carbon::now(),
        ];
        $User = new User;
        $User->fill($param)->save();

        $param = [
            'name' => 'test3',
            'email' => 'test3@gmail',
            'password' => 'password',
            'email_verified_at' => Carbon::now(),
        ];
        $User = new User;
        $User->fill($param)->save();
    }
}
