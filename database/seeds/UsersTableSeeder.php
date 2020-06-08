<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        create(User::class, [
            'nickname' => 'Testing',
            'email' => 'ian@l7.lan',
            'password' => '$2y$10$9N0LlCZq8PCxbim5ilQbsuqKwEgNuLd1n74CS7ez7r6Qrx81HJaBa' // '11111111'
        ]);
    }
}
