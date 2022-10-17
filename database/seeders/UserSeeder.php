<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrcreate([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'is_admin' => true
        ]);
        $users = [
            [
                'name' => 'Аркадий',
                'email' => 'a_test@gmail.com'
            ],
            [
                'name' => 'Аккакий',
                'email' => 'b_test@gmail.com'
            ],
            [
                'name' => 'Алексей',
                'email' => 'c_test@gmail.com'
            ],
            [
                'name' => 'Мухибуло',
                'email' => 'd_test@gmail.com'
            ],
            [
                'name' => 'Хаджи-Муса',
                'email' => 'e_test@gmail.com'
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate($user);
        }
    }
}
