<?php

use function Pest\Laravel\get;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RoleSeeder;
use App\Repositories\Article\ArticleRepository;
use App\Services\ArticleService;

uses(RefreshDatabase::class);

beforeEach(function () {
    
    $this->seed(RoleSeeder::class);
    $this->admin = User::factory()->create();
    $this->service= new ArticleService(new ArticleRepository());
});

it('articles_screen_can_be_renderd_by_authenticated_user', function () {

    actingAs($this->admin)
        ->get('/articles')
        ->assertStatus(200);
});

it('articles_screen_can_not_be_renderd_by_unauthenticated_user', function () {
        $this->get('/articles');
        $this->assertGuest();
});

it('create_article_screen_can_be_renderd_by_authenticated_user', function () {
    
    actingAs($this->admin)
        ->get('/articles/create')
        ->assertStatus(200);
});

it('create_article_screen_can_not_be_renderd_by_unauthenticated_user', function () {
    $this->get('/articles/create');
    $this->assertGuest();
}); 

it('edit_article_screen_can_be_renderd_by_authenticated_user', function () {

   $this->actingAs($this->admin);

    $data = [
        'title' => 'New article',
        'content' => 'article content',
        'created_by' => $this->admin->id
    ];
    $article =  $this->service->store($data);

    $this->get('/articles/'.$article->id.'/'.'edit')
        ->assertStatus(200);
});

it('show_article_screen_can_be_renderd_by_authenticated_user', function () {

     $this->actingAs($this->admin);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $this->admin->id
     ];
     $article =  $this->service->store($data);
 
     $this->get('/articles/'.$article->id)
         ->assertStatus(200);
 });

