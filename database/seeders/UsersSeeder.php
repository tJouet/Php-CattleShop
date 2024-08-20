<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {

        $users = [
            [
                'name' => 'Jean Michel',
                'email' => 'jeanmichel64@mink.com',
                'password' => bcrypt('minkIsGo@t.64'),
                'phone' => '0622334455',
            ],
        ];

        foreach($users as $user) {
            $existingUser = User::where('email', $user['email'])->first();
            if (!$existingUser) {
                User::create($user);
            }
        }

        User::factory()->count(2)->create();

    }
}
