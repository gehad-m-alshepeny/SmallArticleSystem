<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
        ]);

       // Create user with admin role
       $user = User::updateOrCreate(['email' => 'admin@gmail.com'],[
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt(env('ADMIN_PASSWORD','admin')),
        'role_id' => ADMIN,
        'email_verified_at' => now(),   
        'remember_token' => Str::random(10),
    ]);
    }
}
