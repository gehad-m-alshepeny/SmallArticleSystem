<?php

use function Pest\Laravel\get;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RoleSeeder;
use App\Providers\RouteServiceProvider;

uses(RefreshDatabase::class);

beforeEach(function () {

    $this->seed(RoleSeeder::class);
    $this->user = User::factory()->create();
});

it('login_screen_can_be_rendered', function () {

    $response = $this->get('/login');
 
    $response->assertStatus(200);
});

it('users_can_authenticate_using_the_login_screen', function () {
 
    $response = $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('users_can_not_authenticate_with_invalid_password', function () {

    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});
