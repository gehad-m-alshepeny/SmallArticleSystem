<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
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
       $admin = User::updateOrCreate(['email' => 'admin@gmail.com'],[
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt(env('ADMIN_PASSWORD','admin')),
        'role_id' => ADMIN,
        'email_verified_at' => now(),   
        'remember_token' => Str::random(10),
      ]);

      // Create user with user role
      $user = User::updateOrCreate(['email' => 'user@gmail.com'],[
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => bcrypt(env('ADMIN_PASSWORD','user')),
        'role_id' => USER,
        'email_verified_at' => now(),   
        'remember_token' => Str::random(10),
      ]);

      //create multi records of admins to test queues
      foreach (range(1,20) as $index){
        User::factory()->create([
            'role_id' => ADMIN,
        ]);
      }

    //create multi records of articles to test caching
      foreach (range(1,20) as $index){
        Article::factory()->create([
            'created_by' => $user->id,
            'approved_by' => $admin->id,
            'approved_at' => now(),   
        ]);
      }
      
    }
}
