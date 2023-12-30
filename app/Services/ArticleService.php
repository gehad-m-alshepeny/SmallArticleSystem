<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use InvalidArgumentException;

class ArticleService
{
    use AuthorizesRequests;
    /**
     * @var $articleRepository
     */
    protected $articleRepository;

    /**
     * ArticleService constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Get all articles.
     *
     * @return String
     */
    public function all()
    {
        $this->authorize('viewAny', Article::class);
        
        return $this->articleRepository->all();
    }

    /**
    * Store article.
    *
    * @return String
    */
    public function store(array $data)
    {
        $this->authorize('create', Article::class);
        
        return $this->articleRepository->store($data);
    }

     /**
    * update article.
    *
    * @return String
    */
    public function update($data, Article $article)
    {
        $this->authorize('update', $article);
        
        return $this->articleRepository->update($data, $article);
    }

     /**
    * view single article.
    *
    * @return String
    */
    public function show($id)
    {
        $this->authorize('view', Article::class);
        
        return $this->articleRepository->show($id);
    }
    /**
    * approve article.
    *
    * @return String
    */
    public function approve($id)
    {
        $this->authorize('approve', Article::class);
        
        return $this->articleRepository->approve($id);
    }
    
     /**
    * view single article.
    *
    * @return String
    */
    public function delete(Article $article)
    {
        $this->authorize('delete', $article);
 
        return $this->articleRepository->delete($article);
    }

    

}