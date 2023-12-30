<?php

use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RoleSeeder;
use App\Providers\RouteServiceProvider;

uses(RefreshDatabase::class);

it('registration_screen_can_be_rendered', function () {

    $response = $this->get('/register');
 
    $response->assertStatus(200);
});

it('new_users_can_register', function () {

    $this->seed(RoleSeeder::class);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role_id'=> USER,
        'password' => 'Password@123456',
        'password_confirmation' => 'Password@123456',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

