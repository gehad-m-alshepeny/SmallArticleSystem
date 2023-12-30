<?php

use function Pest\Laravel\get;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RoleSeeder;
use App\Repositories\Article\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

beforeEach(function () {
    
    $this->seed(RoleSeeder::class);
    $this->admin = User::factory()->create(['role_id'=>ADMIN]);
    $this->service= new ArticleService(new ArticleRepository());
});

 it('create_article', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $user->id
     ];
     $response =  $this->service->store($data);
 
    $this->assertTrue(isset($response->id));
 });

 it('update_article', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $user->id
     ];
    $article =  $this->service->store($data);
     
    $this->service->update(['title' => 'article','content' => 'article content'], $article);

    $this->assertTrue($article->title == 'article');

 });

 it('delete_article', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($user);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $user->id
     ];
    $article =  $this->service->store($data);
     
    $this->service->delete($article);

    $this->assertTrue(Article::find($article->id) == null);

 });

 it('approve_article', function () {

    $user = User::factory()->create(['role_id'=>USER]);

    $this->actingAs($this->admin);
 
     $data = [
         'title' => 'New article',
         'content' => 'article content',
         'created_by' => $user->id,
         'status'=>'pending',
     ];
    $article =  $this->service->store($data);
     
    $this->service->approve($article->id);

    $this->assertTrue(Article::find($article->id)->status == 'approved');

 });

