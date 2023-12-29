<?php

use function Pest\Laravel\get;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RoleSeeder;
use App\Repositories\Article\ArticleRepository;

uses(RefreshDatabase::class);

beforeEach(function () {
    
    $this->seed(RoleSeeder::class);
    $this->user = User::factory()->create();
    
});

it('articles_screen_can_be_renderd_by_registerd_user', function () {

    actingAs($this->user)
        ->get('/articles')
        ->assertStatus(200);
});

it('create_article_screen_can_be_renderd_by_registerd_user', function () {
    
    actingAs($this->user)
        ->get('/articles/create')
        ->assertStatus(200);
});

it('edit_article_screen_can_be_renderd_by_registerd_user', function () {

   $auth= $this->actingAs($this->user);

    $data = [
        'title' => 'New article',
        'content' => 'article content',
    ];
    $article = (new ArticleRepository)->store($data);

    $auth->get('/articles/'.$article->id.'/'.'edit')
        ->assertStatus(200);
});

it('show_article_screen_can_be_renderd_by_registerd_user', function () {

    $auth= $this->actingAs($this->user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
     ];
     $article = (new ArticleRepository)->store($data);
 
     $auth->get('/articles/'.$article->id)
         ->assertStatus(200);
 });
