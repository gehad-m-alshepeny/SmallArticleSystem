<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Article;
use Validator;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
   
class ArticleController extends BaseController
{
    /**
     * @var articleService
     */
    protected $articleService;

    /**
     * ArticleController Constructor
     *
     * @param ArticleService $articleService
     *
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleService->all();
    
        return $this->sendResponse(ArticleResource::collection($articles), 'Articles retrieved successfully.');
    }

}