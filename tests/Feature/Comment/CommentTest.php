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

 it('create_comment', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $this->admin->id
     ];
     $article =  $this->articleService->store($data);

     $comment = [
        'article_id' => $article->id,
        'content' => 'new comment',
    ];
    $response =  $this->commentService->store($comment);
 
    $this->assertTrue(isset($response->id));
 });

 

