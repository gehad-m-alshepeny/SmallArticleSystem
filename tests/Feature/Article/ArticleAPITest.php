<?php

use function Pest\Laravel\get;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RoleSeeder;
use App\Repositories\Article\ArticleRepository;
use App\Services\ArticleService;
use App\Repositories\Comment\CommentRepository;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

beforeEach(function () {
    
    $this->seed(RoleSeeder::class);
    $this->admin = User::factory()->create(['role_id'=>ADMIN]);
    $this->articleService= new ArticleService(new ArticleRepository());
    $this->commentService= new CommentService(new CommentRepository());
});

 it('retrive_articles_API', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $user->id
     ];
     $response =  $this->articleService->store($data);
 
     $response = $this->getJson('/api/articles');
     $response->assertStatus(200)
              ->assertJson([
                 'data' => [
                     [
                        'title' => 'New article',
                        'content' => 'article content',
                     ]
                 ]
             ]);
  
 });
 it('retrive_articles_with_comments_API', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $user->id
     ];
     $article= $this->articleService->store($data);

    $comment = [
        'article_id' => $article->id,
        'content' => 'new comment',
    ];
     $this->commentService->store($comment);
 
     $response = $this->getJson('/api/articles');
     $response->assertStatus(200)
              ->assertJson([
                 'data' => [
                     [
                        'title' => 'New article',
                        'content' => 'article content',
                        'comments'=> [
                            [
                                'content' => 'new comment'
                            ],
                            ]
                     ]
                 ]
             ]);
  
 });



